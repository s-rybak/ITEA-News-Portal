<?php
/**
 * Created by PhpStorm.
 * User: sergej
 * Date: 10/26/18
 * Time: 8:42 PM
 */

namespace App\Repository;


use App\Entity\Post;

interface PostRepositoryInterface {

	public function save(Post $post):void ;
	public function saveAll(iterable $post):void ;
	public function getLatest(int $count):iterable ;
	public function getById(int $id):Post ;
	public function getByCategory(int $id):iterable ;

}