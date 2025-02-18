<?php
    /** add actions + filter */
    add_filter( 'acf/json/save_file_name', 'custom_acf_json_filename', 10, 3 );
    add_filter( 'acf/json/save_paths', 'custom_acf_json_save_paths', 10, 2 );
    add_filter( 'acf/settings/load_json', 'my_acf_json_load_point' );

    function get_acf_element_location( $location ) {
        $acfElementLocation = array();
        $acfElementLocationParam = array();

        array_walk_recursive($location, function($value,$key) use(&$acfElementLocation, &$acfElementLocationParam){
            if($key == 'value') $acfElementLocation[] = $value;
            if($key == 'param') $acfElementLocationParam[] = $value;
        });

        // Convert array to string
        $acfElementLocation = implode("", $acfElementLocation);
        $acfElementLocationParam = implode("", $acfElementLocationParam);

        // Replace acf path
        $acfElementLocation = str_replace("acf/", "", $acfElementLocation);

        return array($acfElementLocation, $acfElementLocationParam);
    }

    // Rename acf json filename
    function custom_acf_json_filename( $filename, $post, $load_path ) {

        if(str_contains($post['title'], 'Clone:')) {
            $filename = str_replace(
                array(
                    ' ',
                    '_',
                ),
                array(
                    '-',
                    '-'
                ),
                $post["fields"][0]["name"]
            );
        } elseif ( str_contains($post['title'], 'Block:') ) {

            list($acfElementLocation, $acfElementLocationParam) = get_acf_element_location($post['location']);

            $filename = str_replace(
                array(
                    ' ',
                    '_',
                ),
                array(
                    '-',
                    '-'
                ),
                $acfElementLocationParam . '-' . $acfElementLocation
            );
        } else {
            $filename = str_replace(
                array(
                    ' ',
                    '_',
                ),
                array(
                    '-',
                    '-'
                ),
                $post['title']
            );
        }

        $filename = strtolower( $filename ) . '.json';

        return $filename;
    }

    // Save acf json files to custom dirs
    function custom_acf_json_save_paths( $paths, $post ) {

        global $acfElementLocation, $acfElementLocationParam;

        // Loop through post location
        list($acfElementLocation, $acfElementLocationParam) = get_acf_element_location($post['location']);

        // Check if post title contains certain value
        if ( str_contains($post['title'], 'Option:') ) {
            $paths = array( get_template_directory() . '/assets/acf-json/options-pages' );
        } elseif ( str_contains($post['title'], 'CPT:') ) {
            $paths = array( get_template_directory() . '/assets/acf-json/cpt' );
        } elseif ( str_contains($post['title'], 'Menu:') ) {
            $paths = array( get_template_directory() . '/assets/acf-json/menu' );
        } elseif ( str_contains($post['title'], 'Clone:') ) {
            $acfPostName = str_replace(
                array(
                    ' ',
                    '_',
                ),
                array(
                    '-',
                    '-'
                ),
                $post["fields"][0]["name"]
            );
            $dirPath = get_template_directory() . '/blocks/_clone/' .  $acfPostName;
            // Create dir if not exists
            if (!file_exists($dirPath)) {
                mkdir($dirPath, 0755, true);
            }
            $paths = array($dirPath);
        } elseif ( str_contains($post['title'], 'Block:') ) {
            $paths = array( get_template_directory() . '/blocks/' .  $acfElementLocation );
        } else {
            $paths = array( get_template_directory() . '/assets/acf-json' );
        }

        return $paths;
    }


    // Load ACF fields
    function my_acf_json_load_point( $paths ) {
        // Get every .json file in blocks
        $blocksDir = glob(get_template_directory() . '/blocks/[!{_clone}]*' , GLOB_ONLYDIR);
        $blocksCloneDir = glob(get_template_directory() . '/blocks/_clone/*' , GLOB_ONLYDIR);
        $customAcfDirs = glob(get_template_directory() . '/assets/acf-json/*' , GLOB_ONLYDIR);

        // Loop through every element
        foreach($blocksDir as $blockDir) {
            $paths[] = $blockDir; // Add every dir to path array
        }

        foreach($blocksCloneDir as $blockCloneDir) {
            $paths[] = $blockCloneDir; // Add every dir to path array
        }

        foreach($customAcfDirs as $customAcfDir) {
            $paths[] = $customAcfDir; // Add every dir to path array
        }

        return $paths;
    }
