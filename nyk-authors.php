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

            // Only proceed if the saved object is a page
            if ($page instanceof Page) {

                // Only proceed if page has template 'Blog Item' (blog_item.html.twig)
                if ($page->name() === 'blog_item' . $page->extension()) {
                    // Only proceed if author is set in frontmatter
                    if (isset($page->header()->taxonomy.author)) {

                    }
                }
            }
        }
    } 
?>