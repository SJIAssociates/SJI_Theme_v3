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
          $classes = "py-5 lg:py-10 ";

          if( $type == 'One Column'){
            $classes .= $block[$type]['padding_top'] . " ";
            $classes .= $block[$type]['padding_bottom'] . " ";
            $classes .= $block[$type]['section_height'];

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

          }
          elseif( $type == 'Two Columns'){

            $classes .= $block[$type]['padding_top'] . " ";
            $classes .= $block[$type]['padding_bottom'] . " ";
            $classes .= $block[$type]['section_height'];

            $column_widths = $block[$type]['column_widths'];

            if($column_widths == 1):
              $leftColumn  = "lg:w-1/4";
              $rightColumn = "lg:w-3/4 lg:pl-10";
            elseif($column_widths == 2):
              $leftColumn  = "lg:w-1/3 lg:pr-5";
              $rightColumn = "lg:w-2/3 lg:pl-5";
            elseif($column_widths == 3):
              $leftColumn  = "lg:w-1/2 lg:pr-5";
              $rightColumn = "lg:w-1/2 lg:pl-5";
            elseif($column_widths == 4):
              $leftColumn  = "lg:w-2/3 lg:pr-5";
              $rightColumn = "lg:w-1/3 lg:pl-5";
            elseif($column_widths == 5):
              $leftColumn  = "lg:w-3/4 lg:pr-10";
              $rightColumn = "lg:w-1/4";
            endif;

            $this_block = (object) [
              'index'               => $i,
              'block_type'          => $type,
              'header'              => $block[$type]['section_header'],
              'content'             => $block[$type]['section_content'],
              'right_column'        => $block[$type]['right_column'],
              'background_color'    => $block[$type]['background_color'],
              'section_classes'     => $classes,
              'left_width'          => $leftColumn,
              'right_width'         => $rightColumn,
              'all_fields'          => $block[$type]
            ];

            array_push($data, $this_block);

          }
          elseif( $type == 'Three Columns'){

            $classes = "py-5 lg:py-10 ";
            $classes .= $block[$type]['padding_top'] . " ";
            $classes .= $block[$type]['padding_bottom'] . " ";
            $classes .= $block[$type]['section_height'];

            $this_block = (object) [
              'index'               => $i,
              'block_type'          => $type,
              'header'              => $block[$type]['section_header'],
              'content'             => $block[$type]['section_content'],
              'middle_column'       => $block[$type]['middle_column'],
              'right_column'       => $block[$type]['right_column'],
              'background_color'    => $block[$type]['background_color'],
              'section_classes'     => $classes,
              'all_fields'          => $block[$type]
            ];

            array_push($data, $this_block);

          }
          elseif( $type == 'Header') {

            if( $block[$type]['padding_top'] != ''): $classes .= $block[$type]['padding_top'] . " "; endif;
            if( $block[$type]['padding_bottom'] != ''):$classes .= $block[$type]['padding_bottom'] . " "; endif;
            $classes .= $block[$type]['section_height'] . " ";
            $classes .= $block[$type]['header_location']. " ";

            if( !empty($block[$type]['background_image']) ){
              $classes .= 'custom-bg';
            }




            $this_block = (object) [
              'index'               => $i,
              'block_type'          => $type,
              'header'              => $block[$type]['section_header'],
              'background_color'    => $block[$type]['background_color'],
              'section_classes'     => $classes,
              'all_fields'          => $block[$type],
              'color'               => $block[$type]['header_color']
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
