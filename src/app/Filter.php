<?php

namespace laravelFilter\filter\app;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class Filter
{

    /**
     * @var Request
     */
    public $request;

    /**
     * @param  Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = array_filter($request->all());
    }


    public function handle($model, Closure $next)
    {
        if (!$this->checkBetweenParameters()) {
            return $next($model);
        }

        if (!$this->checkBetweenParameters()) {
            return $next($model);
        }

        $builder = $next($model);

        return $this->applyFilter($builder);
    }

    /**
     * @return bool
     */
    private function checkBetweenParameters() : bool
    {
        return ($this->applyType() === 'between' &&
            (array_key_exists($this->applyFirst(), $this->request) ||
            array_key_exists($this->applySecond(), $this->request)));
    }

    /**
     * @return bool
     */
    private function checkSingleParameters() : bool
    {
        return ($this->applyType() !== 'between' &&
            array_key_exists($this->applyFirst(), $this->request));
    }

    protected abstract function applyType();

    protected abstract function applyFilter($builder);

    protected abstract function applyFirst();

    protected abstract function applySecond();

}