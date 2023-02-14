<?php

// notes on precedence of logical operators:
// https://chortle.ccsu.edu/java5/Notes/chap40/ch40_16.html
// validate boolean expression
// https://stackoverflow.com/questions/42528748/validate-a-boolean-expression-with-brackets-in-javascript-regex

namespace App\Http\Livewire\Components;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class BooleanExpressionEditor extends Component
{
    // display
    public $isMobile;// set in individual component

    // the expression
    public array $searchItems;
    public $operators = ['(', ')', 'AND', 'OR', 'NOT'];
    public array $expressionItems;
    public $expressionValid;
    public $queryError;
    public $queryErrorMessage;

    // queries
    public string $searchField; // e.g. 'tags' passed in as parameter
    public string $queryJson;

    protected $listeners = [
        'searchCleared' => 'onSearchCleared',
        'queryError' => 'onQueryError'
        ];

    public function mount()
    {
        $this->resetVars();
    }

    public function onSearchCleared()
    {
        $this->resetVars();
    }

    public function onQueryError(string $message)
    {
        $this->queryError = true;
        $this->queryErrorMessage = $message;
        Log::debug($this->searchField." query caused an exception: ". serialize($this->expressionItems). ' Message to user: '.$message);
    }

    public function resetVars()
    {
        $this->expressionItems = [];
        $this->expressionValid = true;
        $this->queryError = false;
        $this->queryErrorMessage = '';
    }

    public function render()
    {
        return view('livewire.components.boolean-expression-editor');
    }

    public function addSearchItem($item)
    {
        $this->expressionItems[] = $item;
        $this->validateExpression();
    }

    public function addOperator($operator)
    {
        $this->expressionItems[] = $operator;
        $this->validateExpression();
    }

    public function removeExpressionItem($index)
    {
        array_splice($this->expressionItems, $index, 1);
        $this->validateExpression();
    }

    public function clearExpression()
    {
        $this->resetVars();
        $this->emit($this->searchField.'Queried', []);
    }

    public function validateExpression()
    {
        if (count($this->searchItems) == 0) {
            return true;
        }

        $valid = true;

        // count brackets
        $numBrackets = 0;
        foreach($this->expressionItems as $expressionItem) {
            $numBrackets += ($expressionItem == '(') || ($expressionItem == ')')? 1 : 0;
        }
        if ($numBrackets % 2 != 0) {
            $valid = false;
        }

        // contains an item that is NOT an operator
        $numSearchItems = 0;
        foreach($this->expressionItems as $expressionItem) {
            $numSearchItems += !in_array($expressionItem, $this->operators) ? 1 : 0;
        }
        if ($numSearchItems == 0) {
            $valid = false;
        }

        // ends with an operator other than ')'
        if ($valid && count($this->expressionItems) > 1) {
            $numItems = count($this->expressionItems); // array_pop causing odd issue
            //Log::info('num now '.$numItems);
            $lastExpressionItem = $this->expressionItems[$numItems - 1];
            if (in_array($lastExpressionItem, $this->operators) && $lastExpressionItem != ')') {
                $valid = false;
            }
        }
        // check search items with no operator between them
        $previousItemType = null;
        foreach($this->expressionItems as $expressionItem) {
            if (in_array($expressionItem, $this->operators)) {
                $itemType = 'operator';
            } else {
                $itemType = 'searchItem';
            }
            if ($itemType == 'searchItem' && $previousItemType == 'searchItem') {
                $valid = false;
                break;
            } else {
                $previousItemType = $itemType;
            }
        }
        $this->expressionValid = $valid;
    }

    public function applyQuery():void
    {
        $this->emit($this->searchField.'Queried', $this->expressionItems);
    }
}
