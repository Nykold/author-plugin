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
                'onAdminSave' => ['addAuthorsNamesToPage', 0],
            ];
        }

        public function addAuthorsNamesToPage($event) {
            // Set $page to the current page being edited
            $page = $event['object'];

            // Apply only to pages under the template 'Blog Item' (blog_item.html.twig)
        }
    } 
?>