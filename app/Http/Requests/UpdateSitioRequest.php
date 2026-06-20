<?php

namespace App\Http\Requests;

class UpdateSitioRequest extends StoreSitioRequest
{
    /**
     * Las reglas de actualización son idénticas a las de creación.
     * Se separan en su propia clase para cumplir con el requisito de
     * "Form Request dedicado" y para poder diferenciarlas a futuro
     * (por ejemplo, si se necesitan reglas distintas al editar).
     */
    public function rules(): array
    {
        return parent::rules();
    }
}
