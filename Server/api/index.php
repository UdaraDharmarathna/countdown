<?php

require 'config.php';
require 'database.php';
require 'countdown.php';
require 'countdownDAO.php';

countdownDAO::setCountdown();
