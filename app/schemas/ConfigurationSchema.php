<?php 

namespace App\Schemas;

use Neomerx\JsonApi\Contracts\Schema\ContextInterface;
use Neomerx\JsonApi\Schema\BaseSchema;


class ConfigurationSchema extends BaseSchema
{
    public function getType(): string
    {
        return 'configurations';
    }

    public function getId($config): ?string
    {
        return $config->id;
    }

    public function getAttributes($config, ContextInterface $context): iterable
    {
        return [
            'seg' => $config->segunda,
            'ter' => $config->terca,
            'qua' => $config->quarta,
            'qui' => $config->quinta,
            'sex' => $config->sexta,
            'sab' => $config->sabado,
            'dom' => $config->domingo,
            'feriado' => $config->feriado,
            'user_id' => $config->user_id,
        ];
    }

    public function getRelationships($config, ContextInterface $context): iterable
    {
        return [
            'hora' => [
                self::RELATIONSHIP_DATA => $config->hora,
                self::RELATIONSHIP_LINKS_SELF => false,
                self::RELATIONSHIP_LINKS_RELATED => false,
            ]
        ];
    }
}
