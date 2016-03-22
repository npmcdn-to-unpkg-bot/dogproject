<?php
/**
 * @SWG\Definition(definition="emails", required={"email"})
 */

/**
 * @SWG\Definition(
 * definition="review",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="user_id", type="integer"),
 * @SWG\Property(property="rating1", type="integer"),
 * @SWG\Property(property="rating2", type="integer"),
 * @SWG\Property(property="rating3", type="integer"),
 * @SWG\Property(property="rating4", type="integer"),
 * @SWG\Property(property="rating5", type="integer"),
 * @SWG\Property(property="name", type="string"),
 * @SWG\Property(property="about", type="string"),
 * @SWG\Property(property="contact_number", type="string"),
 * @SWG\Property(property="approved", type="integer"),
 * @SWG\Property(property="suburb", ref="#/definitions/suburb", description = "Suburb information"),
 * @SWG\Property(property="state", ref="#/definitions/state", description = "State information")
 * )
 */