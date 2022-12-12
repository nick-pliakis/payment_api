<?php

namespace Interfaces;

interface Authenticator
{

    public function authenticate($token);

}