<?php 

namespace App\Schemas;

use Neomerx\JsonApi\Contracts\Schema\ContextInterface;
use Neomerx\JsonApi\Schema\BaseSchema;


class FeriadoSchema extends BaseSchema
{
    public function getType(): string
    {
        return 'feriado';
    }

    public function getId($feriado): ?string
    {
        return $feriado->id;
    }

    public function getAttributes($feriado, ContextInterface $context): iterable
    {
        return [
            'data' => $feriado->data,
            'descricao' => $feriado->descricao,
            'configuration_id' => $feriado->configuration_id,
        ];
    }

    public function getRelationships($feriado, ContextInterface $context): iterable
    {
        return [];
    }
}
