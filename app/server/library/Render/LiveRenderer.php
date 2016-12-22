<?php
namespace Render;

use Render\Cache\FileBasedJsonCache;
use Render\InfoStorage\WebsiteInfoStorage\ArrayBasedWebsiteInfoStorage;
use Render\InfoStorage\WebsiteInfoStorage\LiveArrayWebsiteInfoStorage;
use Render\InfoStorage\ColorInfoStorage\ArrayBasedColorInfoStorage;
use Render\InfoStorage\ModuleInfoStorage\ArrayBasedModuleInfoStorage;
use Render\InfoStorage\ModuleInfoStorage\IModuleInfoStorage;
use Render\InfoStorage\NavigationInfoStorage\ArrayBasedNavigationInfoStorage;
use Render\InfoStorage\NavigationInfoStorage\LiveArrayNavigationInfoStorage;
use Render\InfoStorage\ContentInfoStorage\IContentInfoStorage;
use Render\InfoStorage\ContentInfoStorage\ArrayBasedContentInfoStorage;
use Render\PageUrlHelper\SimplePageUrlHelper;
use Render\NodeTree;

/**
 * Class LiveRenderer
 *
 * Render Entry Point for Live Pages.
 * Heavily relies on constants and files generated by Creator.
 * TODO: move this file out of \Render ?!
 * TODO: consolidate all website global data files into one?
 */
class LiveRenderer extends AbstractRenderer
{

  /**
   * @var string
   */
  private $pageId;

  /**
   * @var RenderContext
   */
  private $renderContext;

  /**
   * @var array
   */
  private $pageMeta;

  /**
   * @param $pageId
   */
  public function __construct($pageId)
  {
    // Page ID
    $this->pageId = $pageId;

    // generated Page Meta
    /** @noinspection PhpIncludeInspection */
    $this->pageMeta = include(PAGES_DATA_PATH . DIRECTORY_SEPARATOR . $this->pageId . DIRECTORY_SEPARATOR . 'meta.php');

    // Node Tree
    $this->nodeTree = $this->createNodeTree();

    // Legacy
    if (isset($this->pageMeta['legacy']) && $this->pageMeta['legacy'] === true) {
      $this->initLegacy();
    }
  }

  /**
   * @return NodeTree
   */
  protected function getNodeTree()
  {
    return $this->nodeTree;
  }

  /**
   * @return RenderContext
   */
  protected function getRenderContext()
  {
    if ($this->renderContext) {
      return $this->renderContext;
    }

    $websiteInfoStorage = $this->createWebsiteInfoStorage();
    $moduleInfoStorage = $this->createModuleInfoStorage();
    $navigationInfoStorage = $this->createNavigationInfoStorage();
    $colorInfoStorage = $this->createColorInfoStorage();
    $mediaContext = $this->createMediaContext();

    $interfaceLocaleCode = 'en_US'; // just fake

    /** @noinspection PhpIncludeInspection */
    $resolutions = include(DATA_PATH . DIRECTORY_SEPARATOR . 'resolutions.php');

    $this->renderContext = new RenderContext(
        $websiteInfoStorage,
        $moduleInfoStorage,
        $navigationInfoStorage,
        $colorInfoStorage,
        $mediaContext,
        $interfaceLocaleCode,
        RenderContext::RENDER_MODE_LIVE,
        RenderContext::RENDER_TYPE_PAGE,
        $resolutions,
        null,
        $this->createCache()
    );

    return $this->renderContext;
  }

  /**
   * @return ArrayBasedWebsiteInfoStorage
   */
  protected function createWebsiteInfoStorage()
  {
    $websiteSettingsDataFile = DATA_PATH . DIRECTORY_SEPARATOR . 'websitesettings.php';
    return new LiveArrayWebsiteInfoStorage($websiteSettingsDataFile);
  }

  /**
   * @return ArrayBasedModuleInfoStorage
   */
  protected function createModuleInfoStorage()
  {
    /** @noinspection PhpIncludeInspection */
    $moduleData = include(DATA_PATH . DIRECTORY_SEPARATOR . 'modules.php');
    return new ArrayBasedModuleInfoStorage($moduleData, MODULES_DATA_PATH, ASSET_PATH, ASSET_WEBPATH);
  }

  /**
   * @return ArrayBasedNavigationInfoStorage
   */
  protected function createNavigationInfoStorage()
  {
    $cssUrl = CSS_WEBPATH . '/' . $this->pageMeta['css']['url'];

    // Page URLs
    /** @noinspection PhpIncludeInspection */
    $pages = include(DATA_PATH . DIRECTORY_SEPARATOR . 'urls.php');

    // Navigation Array (parent child relations and page title)
    // navigation.php does not include the globals (LiveArrayNavigationInfoStorage loads them via include if needed)
    /** @noinspection PhpIncludeInspection */
    $navArray = include(DATA_PATH . DIRECTORY_SEPARATOR . 'navigation.php');

    $pageUrlHelper = new SimplePageUrlHelper($pages, $this->pageId, $cssUrl, SITE_WEBPATH . '/');
    return new LiveArrayNavigationInfoStorage(PAGES_DATA_PATH, $navArray, $this->pageId, $pageUrlHelper);
  }

  /**
   * @return ArrayBasedColorInfoStorage
   */
  protected function createColorInfoStorage()
  {
    /** @noinspection PhpIncludeInspection */
    $colorArray = include(DATA_PATH . DIRECTORY_SEPARATOR . 'colors.php');
    return new ArrayBasedColorInfoStorage($colorArray);
  }

  /**
   * @return LiveMediaContext
   */
  protected function createMediaContext()
  {
    return new LiveMediaContext(true);
  }

  /**
   * @return NodeTree
   */
  protected function createNodeTree()
  {
    /** @noinspection PhpIncludeInspection */
    $content = include(PAGES_DATA_PATH . DIRECTORY_SEPARATOR . $this->pageId . DIRECTORY_SEPARATOR . 'contentarray.php');
    $nodeFactory = new NodeFactory($this->createNodeContext());
    return new NodeTree($content, $nodeFactory);
  }

  /**
   * @return NodeContext
   */
  protected function createNodeContext()
  {
    return new NodeContext($this->getRenderContext()->getModuleInfoStorage(),
      $this->createContentInfoStorage(), $this->pageId, null);
  }

  /**
   * @return IContentInfoStorage
   */
  protected function createContentInfoStorage()
  {
    $templateArray = array();
    return new ArrayBasedContentInfoStorage($templateArray);
  }

  protected function initLegacy()
  {
    // use the full path here, DO NOT convert this to use ...
    // if you do, it will fail in case of disabled legacy support
    // as the files are not copied to target server
    /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
    \Dual\Render\RenderContext::init($this->getRenderContext(), $this->pageMeta['websiteId'], $this->pageId);
  }

  /**
   * @return \Render\Cache\ICache
   */
  protected function createCache()
  {
    $cachePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'rz_cache' . DIRECTORY_SEPARATOR . $this->pageMeta['websiteId'] . DIRECTORY_SEPARATOR . $this->pageId;
    $this->createDirIfNotExists($cachePath, true);
    return new FileBasedJsonCache($cachePath);
  }

  /**
   * @param $directory
   * @param bool $recursive
   * @param int $mode
   * @return bool
   */
  protected function createDirIfNotExists($directory, $recursive = false, $mode = 0777)
  {
    if (!@is_dir($directory)) {
      return @mkdir($directory, $mode, $recursive);
    }
    return true;
  }
}
