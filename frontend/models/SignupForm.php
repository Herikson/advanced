<?php
namespace frontend\models;

use backend\models\AuthAssignment;
use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $password;
    public $permissions;
    public $coordinates;
    public $original_thumbnail;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username' ,'filter', 'filter' => 'trim'],
            ['username','required'],
            ['first_name', 'required','message'=>'Campo Obrigatorio, Favor Preencher'],
            ['last_name', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['coordinates','string'],
            ['original_thumbnail','string'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {

                
                $permissionsList = $_POST['SignupForm']['permissions'];

                foreach ($permissionsList as $value) {
                    $newPermissions = new AuthAssignment;
                    $newPermissions->user_id=$user->id;
                    $newPermissions->item_name=$value;
                    $newPermissions->save();
                }
                
                return $user;
            }
        }

        return null;
    }
}
