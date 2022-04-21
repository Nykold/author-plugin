<?php
    namespace Grav\Plugin;

    use Grav\Common\Plugin;
    use Grav\Plugin\Admin\Admin;
    use Grav\Common\Page\Page;
    use Grav\Common\Taxonomy;

    class NykAuthorsPlugin extends Plugin {

        public static function getSubscribedEvents() {

            // The plugin will act whenever the page is saved, updating the author list if the taxonomy is changed
            return [
                'onAdminSave' => ['onAdminSave', 0],
            ];
        }

        public function onAdminSave($event) {
            // Load plugin config into a variable
            $config = $this->config();
            $authorsConfig = $config['authors'];

            // Set $page to object being saved
            $page = $event['object'];

            // Only proceed if the saved object is a page
            if ($page instanceof Page) {
                // Only proceed if page has template 'Blog Item' (blog_item.html.twig)
                if ($page->name() === 'blog_item' . $page->extension()) {
                    // Check for authors in frontmatter
                    if (isset($page->header()->taxonomy['author'])) {
                        $pageAuthors = $page->header()->taxonomy['author'];
                    } else {
                        $pageAuthors = [];
                    }

                    // If no authors defined, do nothing
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
                    } else {
                        
                    }
                }
            }
        }
    } 
?>