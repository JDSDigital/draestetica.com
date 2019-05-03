<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Clients;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $lastname;
    public $email;
    public $rut;
    public $birthday;
    public $password;
    public $repassword;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'string', 'max' => 255],
            
            ['lastname', 'trim'],
            ['lastname', 'required'],
            ['lastname', 'string', 'max' => 255],
            
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Clients', 'message' => 'Esta dirección de correo ya se encuentra registrada.'],

            ['rut', 'trim'],
            ['rut', 'required'],
            ['rut', 'string', 'max' => 255],
            
            ['birthday', 'trim'],
            ['birthday', 'required'],
            ['birthday', 'string', 'max' => 255],

            [['password', 'repassword'], 'required', 'on' => ['create']],
            ['password', 'string', 'min' => 6],
            [
                'repassword',
                'compare',
                'compareAttribute' => 'password',
                'message' => Yii::t('app', 'Las contraseñas deben coincidir.'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Nombre',
            'lastname' => 'Apellido',
            'email' => 'Correo',
            'rut' => 'RUT',
            'birthday' => 'Fecha de nacimiento',
            'password' => 'Contraseña',
            'repassword' => 'Repetir contraseña',
        ];
    }

    /**
     * Signs user up.
     *
     * @return Clients|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $client = new Clients();
        $client->name = $this->name;
        $client->lastname = $this->lastname;
        $client->email = $this->email;
        $client->rut = $this->rut;
        $client->birthday = $this->birthday;
        $client->setPassword($this->password);
        $client->generateAuthKey();
        
        return $client->save() ? $client : null;
    }
}
