<?php
    namespace Grav\Plugin;

    use Grav\Common\Plugin;
    use Grav\Plugin\Admin\Admin;

    class NykAuthorPlugin extends Plugin {
        public static function getSubscribedEvents() {
            return [
                'onAdminCreatePageFrontmatter' => ['addAuthorsNamesToPage', 0],
            ];
        }

        public function addAuthorsNamesToPage($event) {
            $page = $event['object'];
        }
    } 
?>