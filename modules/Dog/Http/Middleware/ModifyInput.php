<?php namespace Modules\Dog\Http\Middleware;

use Closure;
use Dingo\Api\Routing\Helpers;


class ModifyInput {

    use Helpers;

    protected $filter = [
        'in' => [
            'state_id',
            'sex',
            'breed'
        ],
        'between' => [
            'cost'
        ],
        'page' => []
    ];

    protected $finalData;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->has('filter'))
        {
            if($data = json_decode($request->input('filter'), true))
            {
                // looping through the URL params and data
                foreach ($data as $key => $fields)
                {
                    // check if filter exists in filter allowed keys
                    if(array_key_exists($key,$this->filter))
                    {
                        // loop through all fields for specific filter
                        foreach($fields as $field => $values)
                        {
                            // if key exists check if field is allowed for that
                            // type of filtering
                            if(in_array($field,$this->filter[$key]))
                            {
                                $this->finalData[$key][$field]  = $values;
                            }
                        }
                    }else
                    {
                        return $this->response()->errorBadRequest("Wrong JSON keys.");
                    }
                }
            }else
            {
                return $this->response()->errorBadRequest("JSON format is not valid.");
            }
            //$filter = $request->input('filter');
            //$page = $request->input('page');
            //$request->replace($this->finalData);
            $request->merge(['filter' => $this->finalData]);
            //$request->input();
            //$request->merge(['filter' => $filter]);
        }
        return $next($request);
    }

}