class WebUser extends CWebUser
{
    public function checkAccess($operation, $params=array())
    {
        if(empty($this->id)) {
            // Гость
            return Yii::app()->authManager->checkAccess($operation, 0);
        }
        return parent::checkAccess($operation, $params);
    }
}