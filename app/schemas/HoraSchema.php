<?php 

namespace App\Schemas;

use Neomerx\JsonApi\Contracts\Schema\ContextInterface;
use Neomerx\JsonApi\Schema\BaseSchema;


class HoraSchema extends BaseSchema
{
    public function getType(): string
    {
        return 'horas';
    }

    public function getId($hora): ?string
    {
        return $hora->id;
    }

    public function getAttributes($hora, ContextInterface $context): iterable
    {
        return [
            'data' => $hora->data,
            'entrada1' => $hora->entrada1,
            'saida1' => $hora->saida1,
            'entrada2' => $hora->entrada2,
            'saida2' => $hora->saida2,
            'dia_da_semana' => $hora->diaDaSemana,
        ];
    }

    public function getRelationships($hora, ContextInterface $context): iterable
    {
        return [
            'configuration' => [
                self::RELATIONSHIP_DATA => $hora->configuration,
                self::RELATIONSHIP_LINKS_SELF => false,
                self::RELATIONSHIP_LINKS_RELATED => false,
            ]
        ];
    }
}
