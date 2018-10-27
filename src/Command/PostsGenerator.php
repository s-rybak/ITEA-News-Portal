<?php

namespace App\Command;

use App\Entity\Post;
use App\Repository\PostRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PostsGenerator extends Command {
	private $repository;

	public function __construct( PostRepositoryInterface $repository, ?string $name = "app" ) {
		parent::__construct( $name );

		$this->repository = $repository;
	}

	protected function configure() {

		$this->setName("app:posts:generator")
		     ->setDescription("generates test posts")
		     ->addArgument("count",InputArgument::OPTIONAL,"Count of post",1);


	}

	protected function execute( InputInterface $input, OutputInterface $output ) {

		$count = $input->getArgument("count");
		$faker =  \Faker\Factory::create();
		$posts = [];

		for ($i = 0; $i < $count; $i++){

			$post = new Post();
			$post
				->setCategoryId(rand(1,3))
				->setTitle($faker->sentence)
				->setBody($faker->text);

			$posts[] = $post;

		}

		$this->repository->saveAll($posts);

		$output->writeln(sprintf("%d post generated",$count));

	}
}