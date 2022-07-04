<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Grav;
use Grav\Common\Flex\Types\Pages\PageObject;
use Grav\Common\Page\Page;
use Grav\Common\Page\Pages;
use Grav\Common\Page\Collection;
use Grav\Common\Plugin;
use Grav\Common\User\DataUser\User as DataUser;
use Grav\Common\User\DataUser\UserCollection;
use Grav\Common\User\User;
use RocketTheme\Toolbox\File\File;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class NykAuthorsPlugin
 * @package Grav\Plugin
 */
class NykAuthorsPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => [
                ['autoload', 100000], //TODO: Remove when plugin requires Grav 1.7
                ['onPluginsInitialized', 0]
            ]
        ];
    }

    /**
     * Composer autoload
     *
     * @return ClassLoader
     */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if not in the admin plugin
        if (!$this->isAdmin()) {
            return;
        }

        // Don't proceed if the plugin is not enabled
        if (!$this->config->get('plugins.nyk-authors.enabled')) {
            return;
        }

        // Enable the main events we are interested in
        $this->enable([
            'onAdminCreatePageFrontmatter' => ['onAdminCreatePageFrontmatter', 0],
            'onAdminSave' => ['onAdminSave', 0]
        ]);
    }

    public function onAdminCreatePageFrontmatter(Event $event)
    {
        /**
         * SECTION Automatic Current User to Frontmatter
         * Automatically adds the current user's username to categories
         */

        $header = $event['header']; // page frontmatter
        $username = $this->grav['user']['username']; // current user's username

        // if categories are currently empty (should be, page just created), save current user's username as category
        if (!isset($header['taxonomy']['category'])) {
            $header['taxonomy']['category'] = array($username);
            $event['header'] = $header; // save the edited frontmatter
        }

        /**
         * !SECTION Automatic Current User to Frontmatter
         */
    }

    public function onAdminSave(Event $event)
    {
        $page = $event['object'] ?? $event['page'];
        $header = $page['header'];

        // Don't proceed if not saving a page
        if (!$page instanceof Page && !$page instanceof PageObject)  {
            return;

        } else {
        /**
         * SECTION Natural Language String
         * Makes a natural language string that can be included in the text (to be saved to frontmatter)
         */
            /**
             * SECTION Fetch Full Names
             * Takes usernames in categories and adds corresponding full names to an array
             */

            $input = $header['taxonomy']['category']; // categories in frontmatter (usernames)

            $authors = array(); // empty array to add full names to
            
            foreach ($input as &$category) {
                $user = $this->grav['accounts']->load($category); // user with each category's username
                if ($user && $user->exists()) {

                    $username = $user['username'];
                    $fullName = $user['fullname'];

                    /**
                     * SECTION Add Links to Authors
                     * Adds links to an author page to each author's name
                     */

                    if (TRUE) { // TODO placeholder for future plugin settings

                        $aTag = '<a rel="author" href="/autor/' . $username . '" target="_blank">';

                        $authorLink = $aTag . $fullName . "</a>";

                        array_push($authors, $authorLink);

                    /**
                     * !SECTION Add Links to Authors
                     */

                    } else {
                        array_push($authors, $fullName);
                    }
                }
            }
            unset($category);
            /**
             * !SECTION Fetch Full Names
             */
    
            // test output to frontmatter (development)
            // $header['test'] = $authors;

            /**
             * SECTION Conjuntion based on lang
             */

            $langConfig = $this->config->get('plugins.nyk-authors.lang');
            $customConjunction = trim($this->config->get('plugins.nyk-authors.custom_lang_conjunction'));

            if ($langConfig == 'en') {
                $conjunction = ' and ';
            } elseif ($langConfig == 'fr') {
                $conjunction = ' et ';
            } elseif ($langConfig == 'de') {
                $conjunction = ' und ';
            } elseif ($langConfig == 'pt') {
                $conjunction = ' e ';
            } elseif ($langConfig == 'es') {
                $conjunction = ' y ';
            } elseif ($langConfig == 'custom' && $customConjunction) {
                $conjunction = ' ' . $customConjunction . ' ';
            } else {
                $conjunction = ', ';
            }

            /**
             * !SECTION Conjunction based on lang
             */

            $lastAuthor = array_pop($authors);
            if ($authors) {
                $authorString = implode(', ', $authors) . $conjunction . $lastAuthor; // TODO add option for conjunctions in other languages
            } else {
                $authorString = $lastAuthor;
            }

            $header['authorString'] = $authorString; // string to be used in the page

            /**
             * SECTION Save Edited Frontmatter
             */
            $page['header'] = $header;
            if ($event['object']) {
                $event['object'] = $page;
            } elseif ($event['page']) {
                $event['page'] = $page;
            }
            /**
             * !SECTION Save Edited Frontmatter
             */

        /**
         * !SECTION Natural Language String
         */
        }
    }
}
