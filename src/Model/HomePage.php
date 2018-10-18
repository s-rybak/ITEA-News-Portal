<?php

namespace App\Model;

/**
 * Home page DTO.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
final class HomePage
{
    private $firstBlockTitle;
    private $firstBlockText;
    private $firstBlockMainBtn;
    private $firstBlockActionBtn;

    public function __construct(
        string $firstBlockTitle,
        string $firstBlockText,
        string $firstBlockMainBtn,
        string $firstBlockActionBtn
    ) {
        $this->firstBlockTitle = $firstBlockTitle;
        $this->firstBlockText = $firstBlockText;
        $this->firstBlockMainBtn = $firstBlockMainBtn;
        $this->firstBlockActionBtn = $firstBlockActionBtn;
    }

    public function getFirstBlockTitle(): string
    {
        return $this->firstBlockTitle;
    }

    public function getFirstBlockText(): string
    {
        return $this->firstBlockText;
    }

    public function getFirstBlockMainBtn(): string
    {
        return $this->firstBlockMainBtn;
    }

    public function getFirstBlockActionBtn(): string
    {
        return $this->firstBlockActionBtn;
    }
}
