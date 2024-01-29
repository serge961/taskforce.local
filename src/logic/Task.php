<?php
namespace Taskforce\logic;

class Task 
{
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'proceceed';
    const STATUS_CANCEL = 'canceled';
    const STATUS_COMPLETE = 'completed';
    const STATUS_FAIL = 'failed';

    const ACTION_RESPONSE = 'action_response';
    const ACTION_CANCEL = 'action_cancel';
    const ACTION_DENY = 'action_deny';
    const ACTION_COMPLETE = 'action_complete';
    const ACTION_RUN = 'action_run';

    const ROLE_PERFORMER = 'performer';
    const ROLE_CLIENT = 'customer';

    private ?int $performerId;
    private int $clientId;

    private $status;

    /**
     * Возвращает карту статусов с названиями
     * @return  array
     */
    public function getStatusMap(): array
    {
        return $mapStatus = [
            self::STATUS_NEW => 'Новая',
            self::STATUS_IN_PROGRESS => 'Выполняется',
            self::STATUS_COMPLETE => 'Завершена',
            self::STATUS_CANCEL => 'Отменена',
            self::STATUS_FAIL => 'Провалена'
        ];
    }

    /**
     * Возвращает карту действий с названиями
     * @return array
     */
    public function getActionMap(): array
    {
        return $mapAction = [
            self::ACTION_CANCEL => 'Отменить',
            self::ACTION_RESPONSE => 'Откликнуться',
            self::ACTION_RUN => 'Запустить',
            self::ACTION_COMPLETE => 'Завершить',
            self::ACTION_DENY => 'Провалить'
        ];
    }

    /** 
    * Создает объект класса
    * @param int $clientId идентификатор клиента
    * @param int $performerId идентификатор исполнителя
    *
    */

    public function __construct(int $clientId, ?int $performerId)
    {
      //  $this->setStatus($status);

        $this->clientId = $clientId;
        $this->performerId = $performerId;
    }

    /**
     * Устанавливает статус задачи
     * @param string $status
     */
    private function setStatus(string $status): void
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

    /**
     * Выводит следующий статус для текущего действия
     * @param string $action действие
     * 
     * @return string возвращает статус
     */
    private function getNextStatus(string $action): ?string
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


    /**
     * Выводит список доступных действий для указанного статуса
     * @param string $status передаваемый статус
     * 
     * @return array доступные действия для указанного статуса
     */
    private function getAction(string $status): array
    {
        $map = [
            self::STATUS_NEW => [self::ACTION_RESPONSE, self::ACTION_CANCEL],
            self::STATUS_IN_PROGRESS => [self::ACTION_COMPLETE, self::ACTION_DENY]
        ];
        
        return $map[$status] ?? [];
    }

}


//$task = new Task(1, 2);
//$task->getNextStatus('action_cancel');

//assert($task->getNextStatus('action_cancel') == Task::ACTION_CANCEL,'action_cancel');



