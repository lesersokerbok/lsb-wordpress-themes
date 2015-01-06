<?php

class TaxonomyUtil {

  public static function get_id($object) {
    if ( is_object($object) && isset($object->term_id) ) {
      return $object->term_id;
    } else {
      return null;
    }
  }

  public static function get_name($object) {
    if ( is_object($object) && isset($object->name) ) {
      return $object->name;
    } else {
      return null;
    }
  }

  public static function the_terms_slug($post_id, $taxonomy) {
    if($post_id && $taxonomy) {
      $terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ));
      echo implode( ' ', $terms );
    }
  }

  public static function get_slug($term, $taxonomy) {
    if ($term && $taxonomy) {
      return get_term($term, $taxonomy)->slug;
    } else {
      return null;
    }
  }

  public static function get_slugs($terms, $taxonomy) {
    if ($terms && $taxonomy && is_array($terms)) {
      $slugs;
      foreach ($terms as $term) {
        $slugs[] = get_term($term, $taxonomy)->slug;
      }
      return implode(',', $slugs);
    } else {
      return null;
    }
  }
  
  public static function get_rewrite_slug_for_taxonomy($taxonomy) {
    $taxObject = get_taxonomy( $taxonomy );
    return $taxObject->rewrite['slug'];
  }

}

?>
