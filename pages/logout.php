<?php
session_destroy();

header('Location: ?disconnected=true');