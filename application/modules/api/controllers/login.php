<?php
/**
 * @author   Dmitriy Rassadkin
 * @created  26.09.14 13:02
 */

/**
 * @namespace
 */
namespace Application;

use Bluz\Application\Exception\BadRequestException;
use Bluz\Application\Exception\NotImplementedException;

/**
 * @SWG\Post(
 *   path="/api/login",
 *   tags={"authorization"},
 *   operationId="login",
 *   summary="Get Token",
 *   @SWG\Parameter(
 *       name="login",
 *       in="formData",
 *       description="Login",
 *       required=true,
 *       type="string"
 *   ),
 *   @SWG\Parameter(
 *       name="password",
 *       in="formData",
 *       description="Password",
 *       required=true,
 *       type="string"
 *   ),
 *   @SWG\Response(response=200, description="Token"),
 *   @SWG\Response(response=400, description="Login and password are required"),
 *   @SWG\Response(response=401, description="User not found")
 * )
 */
return
/**
 * @return array
 */
function () {
    /**
     * @var Bootstrap $this
     */
    if ($this->getRequest()->isPost()) {
        $params = $this->getRequest()->getAllParams();

        if (!array_key_exists('login', $params) || !array_key_exists('password', $params)) {
            throw new BadRequestException('Login and password are required');
        }

        // try to authenticate
        $equalsRow = Auth\Table::getInstance()->checkEquals($params['login'], $params['password']);

        // create auth row with token
        $tokenRow = Auth\Table::getInstance()->generateToken($equalsRow);

        return ['token' => $tokenRow->token];
    } else {
        throw new NotImplementedException();
    }
};
