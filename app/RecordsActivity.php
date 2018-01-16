<?php

namespace App;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        if (auth()->guest()) {
            return;
        }
        foreach (static::getActivitiesToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }
        static::deleting(function ($model) {
            $model->activity()->delete();
        });
    }
    /**

  * Fetch all model events that require activity recording.
       *
      * @return array
       */
    protected static function getActivitiesToRecord()
    {
        return ['created'];
    }
    protected function recordActivity($event)
    {
        $this->activity()->create([
        'user_id'=>auth()->id(),
        'type'=>$this->getActivityType($event)
    ]);
    }
    public function activity()
    {
        return $this->morphMany('\App\Activity', 'subject');
    }
    public function getActivityType($event)
    {
        $type=strtolower((new \ReflectionClass($this))->getShortname());
        return "{$event}_{$type}";
    }
}
