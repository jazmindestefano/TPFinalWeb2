<?php
include_once('helpers/MySqlDatabase.php');
include_once("helpers/MustacheRender.php");
include_once('helpers/Router.php');


include_once('model/LoginModel.php');
include_once('model/RegisterModel.php');
include_once('model/PerfilModel.php');
include_once('model/RankingModel.php');
include_once('model/PreguntaModel.php');
include_once('model/PartidaModel.php');


include_once('controller/HomeController.php');
include_once('controller/LoginController.php');
include_once('controller/RegisterController.php');
include_once('controller/PerfilController.php');
include_once('controller/LogoutController.php');
include_once('controller/RankingController.php');
include_once('controller/PreguntaController.php');
include_once('controller/PartidaController.php');

include_once('third-party/mustache/src/Mustache/Autoloader.php');


class Configuration
{
    private $configFile = 'config/config.ini';

    public function __construct()
    {
    }

    public function getHomeController()
    {
        return new HomeController($this->getRenderer());
    }

    private function getArrayConfig()
    {
        return parse_ini_file($this->configFile);
    }

    private function getRenderer()
    {
        return new MustacheRender('view/partial');
    }

    public function getDatabase()
    {
        $config = $this->getArrayConfig();
        return new MySqlDatabase(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['database']);
    }

    public function getRouter()
    {
        return new Router(
            $this,
            "getHomeController",
            "list");
    }

    public function getLogoutController()
    {
        return new LogoutController();
    }

    public function getLoginController()
    {
        return new LoginController(
            new LoginModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

    public function getRegisterController()
    {
        return new RegisterController(
            new RegisterModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

    public function getPerfilController()
    {
        return new PerfilController(
            new PerfilModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

    public function getRankingController()
    {
        return new RankingController(
            new RankingModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

    public function getPreguntaController()
    {
        return new PreguntaController(
            new PreguntaModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

    public function getPartidaController()
    {
        return new PartidaController(
            new PartidaModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

}
