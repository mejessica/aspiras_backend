<?php 

namespace App\Schemas;

use Neomerx\JsonApi\Contracts\Schema\ContextInterface;
use Neomerx\JsonApi\Schema\BaseSchema;


class UserSchema extends BaseSchema
{
    public function getType(): string
    {
        return 'user';
    }

    public function getId($user): ?string
    {
        return $user->id;
    }

    public function getAttributes($user, ContextInterface $context): iterable
    {
        return [
            'email' => $user->email,
            'nome' => $user->nome,
            'data_nasc' => $user->data_nasc,
            'endereco' => $user->endereco,
            'bairro'=>$user->bairro,
            'cidade' => $user->cidade,
            'estado' => $user->estado,
            'pais' => $user->pais,
            // 'password' => !empty($user->password),
        ];
    }

    public function getRelationships($user, ContextInterface $context): iterable
    {
        return [];
    }
}
