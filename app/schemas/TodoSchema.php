<?php 

namespace App\Schemas;

use Neomerx\JsonApi\Contracts\Schema\ContextInterface;
use Neomerx\JsonApi\Schema\BaseSchema;


class TodoSchema extends BaseSchema
{
    public function getType(): string
    {
        return 'todo';
    }

    public function getId($todo): ?string
    {
        return $todo->id;
    }

    public function getAttributes($todo, ContextInterface $context): iterable
    {
        return [
            'nome' => $todo->nome,
            'data_termino' => $todo->data_termino,
            'user_id' => $todo->user_id,
        ];
    }

    public function getRelationships($todo, ContextInterface $context): iterable
    {
        return [];
    }
}
