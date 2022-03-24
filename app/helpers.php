<?php

//namespace App;

if (!function_exists('seconds_to_hours')) {
    function seconds_to_hours(int $seconds): float
    {
        return $seconds / 3600;
    }
}

if (!function_exists('profiles')) {
    function profiles(): \Illuminate\Support\Collection
    {
        $profiles = array();
        if (session()->get('active_operator_type')[0] == 'i') {
            if (auth()->user()->organisation != null) {
                $data = auth()->user()->getOrganisations()->toArray();
                foreach ($data as $key => $value) {
                    $profiles[$key] = array_merge($data[$key], ['is_user' => false]);
                }
            } else
                $profiles = auth()->user()->getName();
        } else {
            $profiles[0] = auth()->user()->getName();
            $current_organisation_id = session()->get('active_operator_id');
            $organisation = \App\Models\Organisation::where('user_id', auth()->id())->where('id', '!=', $current_organisation_id)->get(['id', 'name']);
            if ($organisation->count() != 0) {
                $organisation = array_merge($organisation[0]->toArray(), ['is_user' => false]);
                $profiles[1] = $organisation;
            }
        }
        return collect($profiles);
    }

}
if (!function_exists('getActiveOperatorType')) {
    function getActiveOperatorType()
    {
        $org = \App\Models\Organisation::find(session()->get('active_operator_id'));
        if ($org != null)
            return $org['name'];
        changeProfileValues('i', auth()->id());
        return '';
    }

}

if (!function_exists('changeProfileValues')) {
    function changeProfileValues($active_operator_type, $active_operator_id)
    {
        session()->forget('active_operator_type');
        session()->put('active_operator_type', $active_operator_type);// i, o
        session()->forget('active_operator_id');
        session()->put('active_operator_id', $active_operator_id);

    }
}

class helpers
{

    public
        $type = 'i';
    protected
        $id = 0;

    function setActiveOperatorType($type)
    {
        $this->type = $type;
    }

    function getActiveOperatorType(): string
    {
//        dd($this->type);
        return $this->type;
    }

    function setActiveOperatorId($id)
    {
        $this->id = $id;
    }

    function getActiveOperatorId(): int
    {
        return $this->id;
    }

}
