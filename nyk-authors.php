<?php
    namespace Grav\Plugin;

    use Composer\Autoload\ClassLoader;
    use Grav\Common\Plugin;
    use Grav\Plugin\Admin\Admin;
    use Grav\Common\Page\Page;
    use Grav\Common\Page\Header;
    use Grav\Common\Page\Interfaces\PageInterface;
    use Grav\Common\Taxonomy;
    use RocketTheme\Toolbox\Event\Event;

    /**
     * Class NykAuthorsPlugin
     * @package Grav\Plugin
     */
    class NykAuthorsPlugin extends Plugin {
        /**
         * @return array
         * 
         * The getSubscribedEvents() gives the core a list of events
         *     that the plugin wants to listen to. The key of each
         *     array section is the event that the plugin listens to
         *     and the value (in the form of an array) contains the
         *     callable (or function) as well as the priority. The
         *     higher the number the higher the priority.
         */
        public static function getSubscribedEvents() {
            return [
                'onPluginsInitialized' => ['onPluginsInitialized', 0],
            ];
        }

         /**
         * Composer autoload.
         * 
         * @return ClassLoader
         */
        
        public function autoload(): ClassLoader {
            return require __DIR__ . '/vendor/autoload.php';
        }

        public function onPluginsInitialized() {
            if ($this->isAdmin()) {
                $this->enable([
                    'onAdminSave' => ['onAdminSave', 0],
                ]);
                return;
            }
        }

        public function onAdminSave(Event $event) {
            // Load plugin config into a variable
            $config = $this->config();
            $authorsConfig = $config['authors'];

            // Set $page to object being saved
            $page = $event['object'];
            $header = $page->header();
            if (!$header instanceof Header) {
                $header = new Header((array)$header);
            }

            // Only proceed if the saved object is a page
            if ($page instanceof Page) {
                // Only proceed if page has template 'Blog Item' (blog_item.html.twig)
                if ($page->name() === 'blog_item' . $page->extension()) {
                    // Check for authors in frontmatter
                    if (isset($header->taxonomy['author'])) {
                        $pageAuthors = $header->taxonomy['author'];
                    } else {
                        $pageAuthors = [];
                    }

                    // If no authors defined, create an empty string
                    if (count($pageAuthors) == 0) {
                        $finalString = "";
                    // If only one author
                    } elseif (count($pageAuthors) == 1) {
                        $authorKey = array_pop($pageAuthors);
                        if (!array_key_exists($authorKey, $authorsConfig)) {
                            $finalString = "";
                        } else {
                            $finalString = $authorsConfig[$authorKey];
                        }
                    // For more than one author
                    } else {
                        $authorsArray = [];
                        foreach($pageAuthors as $authorKey){
                            $authorsArray[] = $authorsConfig[$authorKey];
                        }

                        $lastAuthor = array_pop($authorsArray);
                        $finalString = implode(', ', $authorsArray);
                        $finalString .= ' e '.$lastAuthor;
                    }

                    // Write finalString into frontmatter
                    if ($finalString) {
                        $header->author_string = $finalString;
                        $page->header() = $header;
                        $event['object'] = $page;
                    }
                }
            }
        }
    } 
?>