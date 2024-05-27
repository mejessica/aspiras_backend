<?php 

namespace App\Schemas;

use Neomerx\JsonApi\Contracts\Schema\ContextInterface;
use Neomerx\JsonApi\Schema\BaseSchema;


class ItemSchema extends BaseSchema
{
    public function getType(): string
    {
        return 'item';
    }

    public function getId($todo_item): ?string
    {
        return $todo_item->id;
    }

    public function getAttributes($todo_item, ContextInterface $context): iterable
    {
        return [
            'descricao' => $todo_item->descricao,
            'prioridade' => $todo_item->prioridade,
            'realizado' => $todo_item->realizado,
            'todo_id' => $todo_item->todo_id,
        ];
    }

    public function getRelationships($todo_item, ContextInterface $context): iterable
    {
        return [];
    }
}
