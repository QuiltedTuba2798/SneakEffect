<?php

/*
 * Copyright (C) 2017-2018 CrackerFR
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

namespace crackerfr\sneakeffect;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\entity\Effect;
use pocketmine\permission\ServerOperator;

class Main extends PluginBase implements Listener {
    
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
	$this->reloadConfig();
        $this->getLogger()->info(TextFormat::YELLOW . "SneakEffect " . TextFormat::GREEN . "Enabled !");
        }
        
    public function onDisable() {
        $this->getLogger()->info(TextFormat::YELLOW . "SneakEffect " . TextFormat::GREEN "Disabled !");   
    }
    
    public function onPlayerSneakEvent(PlayerToggleSneakEvent $e) {
            $cfg = $this->getConfig();
            
            $p = $e->getPlayer();
            
            $effectid = $cfg->get("ID-Effect");
            $duration = $cfg->get("Duration");
            $amplifier = $cfg->get("Amplifier");
            
            $effect = Effect::getEffect($effectid);
            $effect->setAmplifier($amplifier);
            $effect->setDuration($duration);
            $p->addEffect($effect);
    }
}
