<?php

class Task 
{
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'proceceed';
    const STATUS_CANCEL = 'canceled';
    const STATUS_COMPLETE = 'completed';
    const STATUS_FAIL = 'failed';

    const ACTION_RESPONSE = 'act_response';
    const ACTION_CANCEL = 'act_cancel';
    const ACTION_DENY = 'act_deny';
    const ACTION_COMPLETE = 'act_complete';
    const ACTION_RUN = 'act_run';

    const ROLE_PERFORMER = 'performer';
    const ROLE_CLIENT = 'customer';

    private ?int $performerId;
    private int $clientId;

    private $status;

    public function getStatusMap()
    {
        return $mapStatus = [
            self::STATUS_NEW => 'Новая',
            self::STATUS_IN_PROGRESS => 'Выполняется',
            self::STATUS_COMPLETE => 'Завершена',
            self::STATUS_CANCEL => 'Отменена',
            self::STATUS_FAIL => 'Провалена'
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

    public function __construct(string $status, int $clientId, ?int $performerId)
    {
        $this->setStatus($status);

        $this->clientId = $clientId;
        $this->performerId = $performerId;
    }

    private function setStatus(string $status)
    {
        $status_set = [
            self::STATUS_NEW,
            self::STATUS_IN_PROGRESS,
            self::STATUS_COMPLETE,
            self::STATUS_CANCEL,
            self::STATUS_FAIL
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
        self::ACTION_DENY => self::STATUS_FAIL
        ];

        return $map[$action] ?? null;
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
