<?php //
namespace Modules\Association\Http\Requests;



use Modules\Foundation\Http\Requests\FoundationRequest;

class AssociationMemberRequest extends FoundationRequest
{
    public function rules()
    {
        switch ($this->httpVerb) {
            case "POST":
                return [
                    'member_email' => 'required|email|exists:user_account_entities,email'
                ];
                break;
            case "DELETE":
                return [
                    'id' => 'required|numeric|exists:user_account_entities,id|exists:association_member_entities,seller_id'
                ];
                break;
        }

    }

    public function authorize()
    {
        return true;
    }


}