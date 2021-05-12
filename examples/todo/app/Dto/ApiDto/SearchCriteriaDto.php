<?php
namespace App\Dto\ApiDto;

use Illuminate\Http\Request;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class SearchCriteriaDto extends FlexibleDataTransferObject
{
    public $perPage;
    public $page;
    public $sortBy;
    public $order;
    public $timeOffset;
    public $current_user;

    public function getPerPage() {
        if(!isset($this->perPage)) {
            return 9999;
        }

        return $this->perPage;
    }

    public function getPage() {
        if(!isset($this->page)) {
            return 1;
        }

        return $this->page;
    }

    public function getSkip() {
        $skip = ($this->getPage() - 1) * $this->getPerPage();
        return $skip;
    }

    public function getSortBy() {
        if(!isset($this->sortBy)) {
            return 'created_at';
        }

        return $this->sortBy;
    }

    public function getOrder() {
        if(!isset($this->order)) {
            return 'desc';
        }

        return $this->order;
    }

    public static function fromRequest(Request $request): ? self
    {
        $result = new self($request->all());

        $result->timeOffset = $request->header('timezone-offset',0);
        return $result;
    }
}
