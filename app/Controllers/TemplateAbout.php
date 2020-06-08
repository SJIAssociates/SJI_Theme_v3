<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplateAbout extends Controller
{
  protected $acf = true;

  public function FlexGenerator(){

    $page_builder = get_field('sections');

    $data = [];

    if ($page_builder) {

        $i = 0;

        foreach($page_builder as $block) {

          $type = $block['acf_fc_layout'];

          if( $type == 'One Column'){

            $classes = $block[$type]['padding_setting'] . " ";
            $classes .= $block[$type]['section_height'] . " ";


            $this_block = (object) [
              'index'               => $i,
              'block_type'          => $type,
              'header'              => $block[$type]['section_header'],
              'content'             => $block[$type]['section_content'],
              'background_color'    => $block[$type]['background_color'],
              'section_classes'     => $classes,
              'all_fields'          => $block[$type]
            ];

            array_push($data, $this_block);

          } elseif( $type == 'Two Columns'){

            $classes = $block[$type]['padding_setting'] . " " . $block[$type]['section_height'];

            $this_block = (object) [
              'index'               => $i,
              'block_type'          => $type,
              'header'              => $block[$type]['section_header'],
              'content'             => $block[$type]['section_content'],
              'right_column'       => $block[$type]['right_column'],
              'background_color'    => $block[$type]['background_color'],
              'section_classes'     => $classes,
              'all_fields'          => $block[$type]
            ];

            array_push($data, $this_block);

          } elseif( $type == 'Header'){

            $classes = $block[$type]['padding_setting'] . " ";
            $classes .= $block[$type]['section_height'] . " ";
            $classes .= $block[$type]['header_location'] . " ";

            if( !empty($block[$type]['background_image']) ){
              $classes .= 'custom-bg';
            }

            $this_block = (object) [
              'index'               => $i,
              'block_type'          => $type,
              'header'              => $block[$type]['section_header'],
              'background_color'    => $block[$type]['background_color'],
              'section_classes'     => $classes,
              'all_fields'          => $block[$type]
            ];

            array_push($data, $this_block);

          }
            //update ForeachIndexLooper
            $i++;
        }

        $data = (object) $data;
        return $data;
    }
  }




}
