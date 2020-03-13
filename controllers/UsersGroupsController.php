<?php
class UsersGroupsController extends MyController
{
    public function getAction($request)
    {
        if (isset($request->url_elements[2]))
        {
            $user_id = (int)$request->url_elements[2];
            if (isset($request->url_elements[3]))
            {
                switch($request->url_elements[3])
                {
                    case 'actions':
                        $db = getDbInstance();

                        $db->where ('id', $user_id);
                        $value = $db->getOne('users_groups', array('id', 'actions'));

                        // http://localhost/spdb/libraries/API/usersgroups/1/actions
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
                $row = $db->getOne('users_groups');

                // http://localhost/spdb/libraries/API/usersgroups/1
                $data['data'] = $row;
            }
        }
        else
        {
            $db = getDbInstance();

            $rows = $db->get('users_groups');

            // http://localhost/spdb/libraries/API/usersgroups
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
