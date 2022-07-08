<?php

namespace achedon\statistiques;

use achedon\statistiques\commands\AdminStats;
use achedon\statistiques\commands\Stats;
use achedon\statistiques\commands\TopDeath;
use achedon\statistiques\commands\TopKill;
use achedon\statistiques\events\playerEvents;
use pocketmine\event\Listener;
use pocketmine\permission\Permission;
use pocketmine\permission\PermissionManager;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class main extends PluginBase implements listener{

    private static Main $instance;

    protected function onEnable(): void
    {
        $this->getLogger()->info("§2Plugin activé");

        PermissionManager::getInstance()->addPermission(new Permission("use.adminstats"));

        $this->getServer()->getPluginManager()->registerEvents(new playerEvents(), $this);

        $this->getServer()->getCommandMap()->registerAll('Commands',[
            new TopKill(),
            new TopDeath(),
            new adminStats(),
            new stats()
        ]);

        self::$instance = $this;

        @mkdir($this->getDataFolder());
    }

    protected function onDisable(): void
    {
        $this->getLogger()->info("§4Plugin désactivé");
    }

    public static function blockBreak(): Config
    {
        return new Config(main::getInstance()->getDataFolder()."blockBreak.yml",Config::YAML);
    }

    public static function death(): Config
    {
        return new Config(main::getInstance()->getDataFolder()."death.yml",Config::YAML);
    }

    public static function kill(): Config
    {
        return new Config(main::getInstance()->getDataFolder()."kill.yml",Config::YAML);
    }

    public static function yo(): Config
    {
        return new Config(main::getInstance()->getDataFolder()."yo.yml",Config::YAML);
    }

    public static function getInstance(): self
    {
        return self::$instance;
    }

}
