<?php
/**
 * @group friend
 */
class FriendsTest extends UnitTestCase
{
    /**
     * @var Friend
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Friend;
    }

    /**
     * to test sending request method
     */
    public function testsendRequest1()
    {
        

        $this->getFixtureManager()->load(array(
                'User',
                'Person',
                'Friend',
        ));
        
        $friend = $this->object->sendRequest(1,'newfriend@a.com');
        $this->assertTrue($friend !== false);
        $this->assertTrue($friend->id_friend > 0);
        
        /*$f2 = new Friend();
        $f2->person2email = 'fdf@dsdsd.com';
        $f2->person2key = "key1";
        $f2->requested_date = date('Y-m-d H:i:s');
        $f2->id_person1 = 2;
        $f2->id_person2 = 0;
        $f2->accepted_date = '';
        if(!$f2->save())
        {
            echo "errors:";
            print_r($f2->getErrors());
        }
        else
            echo "no errors:" . $f2->id_friend;*/             
    }
}
