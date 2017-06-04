<?php

namespace App\Controller\User;

/**
 * Search Users Controller.
 */
class SearchUsers extends BaseUser
{
    /**
     * Search users by name.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function searchUsers($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $result = $this->getUserService()->searchUsers($this->args['query']);

            return $this->jsonResponse('success', $result, 200);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }
}