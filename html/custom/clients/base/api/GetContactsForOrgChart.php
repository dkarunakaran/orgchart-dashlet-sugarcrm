<?php

require_once('include/TimeDate.php');

class GetContactsForOrgChart extends SugarApi
{

    // This function is only called whenever the rest service cache file is deleted.
    // This shoud return an array of arrays that define how different paths map to different functions
    public function registerApiRest() {
        return array(
            'GetContactsForOrgChartData' => array(
                // What type of HTTP request to match against, we support GET/PUT/POST/DELETE
                'reqType' => 'GET',
                // This is the path you are hoping to match, it also accepts wildcards of ? and <module>
                'path' => array('Contacts','org_chart_data', '?','?'),
                // These take elements from the path and use them to populate $args
                'pathVars' => array('', '', 'module','moduleID'),
                // This is the method name in this class that the url maps to
                'method' => 'GetContactsForOrgChartData',
                // The shortHelp is vital, without it you will not see your endpoint in the /help
                'shortHelp' => 'Get Contacts for Org chart data',
                // The longHelp points to an HTML file and will be there on /help for people to expand and show
                'longHelp' => '',
            ),
        );
    }

    public function GetContactsForOrgChartData($api, $args)
    {
        global $current_user;

        //Get relatonship table to Contacts;
        $content = array();
        $content['id'] = 10000;
        $content['x0'] = 0;
        $content['y0'] = 0;
        $content['name'] = 'Organisation';
        $content['title'] = '';
        $content['level'] = 'none';
        $content['children'] = array();
        $query = new SugarQuery();
        $query->from(BeanFactory::getBean($args['module']));
        $contacts = $query->join('contacts')->joinName();
        //$query->select(array("$contacts.id", "$contacts.title", "$contacts.full_name", "$contacts.reports_to_id", "$contacts.relationship_strength_c"));
        $query->select(array("$contacts.id", "$contacts.title", "$contacts.full_name", "$contacts.reports_to_id"));
        $query->where()->equals('id', $args['moduleID']);
        $results = $query->execute();

        //Creating the tree
        $content['children'] = $this->buildTree($results);
        return array('content' => $content);
    }

    public function buildTree(array $elements, $parentId = null) {
        $branch = array();

        foreach ($elements as $element) {
            $element['name'] = $element['rel_full_name_first_name'].' '.$element['rel_full_name_last_name'];
            //$element['level'] = "#".$element['relationship_strength_c'];
            if ($element['reports_to_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }

                $branch[] = $element;
            }
        }

        return $branch;
    }
}
