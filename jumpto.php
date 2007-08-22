<?php
/*
Plugin Name: Jump-to
Plugin URI: http://urbangiraffe.com/plugins/jumpto/
Version: 1.1
Description: Uses post meta-data to add a drop-down page selection box to posts.  Ideally suited for multi-page messages, but could equally be used to add a 'jump-to' feature to anything.
Author: John Godley
Author URI: http://urbangiraffe.com
*/

include (dirname (__FILE__).'/plugin.php');

class JumpTo extends JumpTo_Plugin
{
	var $perma;
	
	function JumpTo ()
	{
		$this->register_plugin ('jumpto', __FILE__);
		
		$this->add_filter ('the_content');
		$this->add_action ('edit_page_form',     'edit');
		$this->add_action ('edit_form_advanced', 'edit');
		$this->add_action ('save_post');
	}
	
	function the_content ($text)
	{
		global $post, $page;
		
		$meta = get_post_meta ($post->ID, 'jumpto', true);
		if (!empty ($meta))
		{
			$this->perma = get_option ('permalink_structure');
			return $text.$this->capture ('jumpto', array ('meta' => $meta, 'current' => $page));
		}
		return $text;
	}
	
	function edit ()
	{
		global $post;
		
		// Count how many pages we have
		$count = preg_match_all ('@--nextpage--@si', $post->post_content, $matches);
		if ($count > 0)
		{
			$existing = get_post_meta ($post->ID, 'jumpto', true);
			if (empty ($existing))
				$existing = array ();
			$this->render_admin ('post', array ('count' => $count + 1, 'existing' => $existing));
		}
	}
	
	function save_post ($id)
	{
		if (isset ($_POST['jumpto']))
		{
			$meta = get_post_meta ($id, 'jumpto', true);
			if (!empty ($meta))
				update_post_meta ($id, 'jumpto', $_POST['jumpto']);
			else
				add_post_meta ($id, 'jumpto', $_POST['jumpto']);
		}
	}
	
	function page_link ($pos)
	{
		global $post;
		
		$url = get_permalink ($post->ID);
		if ($this->perma == '')
			return $url.'?page='.$pos;
		else
			return trailingslashit (rtrim ($url, '/').'/'.$pos);
	}
}

$jumpto = new JumpTo ();
?>