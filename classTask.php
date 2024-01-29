<?php

class Task 
{
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'proceceed';
    const STATUS_CANCEL = 'cancel';
    const STATUS_COMPLETE = 'complete';
    const STATUS_EXPIRED = 'expired';

    const ACTION_RESPONSE = 'act_response';
    const ACTION_CANCEL = 'act_cancel';
    const ACTION_DENY = 'act_deny';
    const ACTION_COMPLETE = 'complete';
    const ACTION_RUN = 'act_run';

    const ROLE_PERFORMER = 'performer';
    const ROLE_CLIENT = 'customer';

    private $performerId;
    private $clientId;

    private $status;

    public function getStatusMap()
    {
        return $mapStatus = [
            self::STATUS_NEW => 'Новая',
            self::STATUS_IN_PROGRESS => 'Выполняется',
            self::STATUS_COMPLETE => 'Завершена',
            self::STATUS_CANCEL => 'Отменена',
            self::STATUS_EXPIRED => 'Провалена'
        ];
    }

    public function getActionMap()
    {
        return $mapAction = [
            self::ACTION_CANCEL => 'Отменить',
            self::ACTION_RESPONSE => 'Откликнуться',
            self::ACTION_RUN => 'Запустить',
            self::ACTION_COMPLETE => 'Завершить',
            self::ACTION_DENY => 'Провалить'
        ];
    }

    public function __construct(string $status, int $costumerId, ?int $employerId)
    {
        $this->setStatus($status);

        $this->costumerId = $costumerId;
        $this->employerId = $employerId;
    }

    private function setStatus(string $status)
    {
        $status_set = [
            self::STATUS_NEW,
            self::STATUS_IN_PROGRESS,
            self::STATUS_COMPLETE,
            self::STATUS_CANCEL,
            self::STATUS_EXPIRED
        ];

        if(in_array($status, $status_set)){
            $this->status = $status;
        }


    }

    private function  getStatus($action)
    {
        $map = [
        self::ACTION_CANCEL => self::STATUS_CANCEL,
        self::ACTION_RESPONSE => self::STATUS_IN_PROGRESS,
        self::ACTION_RUN => self::STATUS_NEW,
        self::ACTION_COMPLETE => self::STATUS_COMPLETE,
        self::ACTION_DENY => self::STATUS_EXPIRED
        ];

        return $map[$action] ?? [];
    }

    private function getAction($status)
    {
        $map = [
            self::STATUS_NEW => [self::ACTION_RESPONSE, self::ACTION_CANCEL],
            self::STATUS_IN_PROGRESS => [self::ACTION_COMPLETE, self::ACTION_DENY]
        ];
        
        return $map[$status] ?? [];
    }




}
