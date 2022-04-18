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
            // Set $page to object being saved
            $page = $event['object'];

            // Check if the saved object is a page
            if ($page instanceof Page) {

                // Apply only to pages under the template 'Blog Item' (blog_item.html.twig)
                if ($page->template() === 'blog_item') {
                    
                }
            }
        }
    } 
?>