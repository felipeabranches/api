<?php
class UsersAccountsController extends MyController
{
    public function getAction($request)
    {
        if (isset($request->url_elements[1]))
        {
            $user_id = (int)$request->url_elements[1];
            if (isset($request->url_elements[2]))
            {
                switch($request->url_elements[2])
                {
                    case 'group':
                        $db = getDbInstance();

                        $db->where ('id', $user_id);
                        $value = $db->get('users_groups');

                        // http://localhost/spdb/libraries/API/usersaccounts/1/group
                        $data['data'] = $value;
                        break;
                    default:
                        // do nothing, this is not a supported action
                        break;
                }
            }
            else
            {
                $db = getDbInstance();

                $db->where ('id', $user_id);
                $row = $db->getOne('users_accounts');

                // http://localhost/spdb/libraries/API/usersaccounts/1
                $data['data'] = $row;
            }
        }
        else
        {
            $db = getDbInstance();

            $rows = $db->get('users_accounts');

            // http://localhost/spdb/libraries/API/usersaccounts
            $data['data'] = $rows;
        }

        return $data;
    }

    public function postAction($request)
    {
        $data = $request->parameters;
        $data['data'] = 'This data was submitted';

        return $data;
    }
}
