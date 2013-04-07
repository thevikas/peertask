<?php
return array(
		array( 
				'id_person' => 10,
				'first_name' => 'testing',
				'last_name' => 'user1',
				'email' => 'testuser1@testing.com',
		),
        
        array(
				'id_person' => 5,
				'first_name' => 'unit1 F' . __LINE__,
				'last_name' => 'unit1 L',
				'email' => 'duplicate@email.com',
		),
        array( 
                'id_person' => 15,
                'first_name' => 'unit1 F' . __LINE__,
                'last_name' => 'unit1 L',
                'email' => 'duplicate1@email.com',
        ),
        array( 
                'id_person' => 20,
                'first_name' => 'unit1 F' . __LINE__,
                'last_name' => 'unit1 L',
                'email' => 'otherduplicate@email.com',
        ),
        
    );

        