<?php
/**
 * Class AssociationModel
 * @ORM\Entity(repositoryClass="Modules\Seller\Repositories\Entities")
 * @ORM\Table(name="seller_verification_entities")
 * * @SWG\Definition(
 * definition="sellerVerification",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="seller_id", type="integer"),
 * @SWG\Property(property="type", type="integer"),
 * @SWG\Property(property="number", type="integer"),
 * @SWG\Property(property="status", type="string")
 * )
 */

/**
 * * @SWG\Definition(
 * definition="sellerHobbyVerification",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="seller_id", type="integer"),
 * @SWG\Property(property="question1", type="integer"),
 * @SWG\Property(property="question2", type="integer"),
 * @SWG\Property(property="question3", type="integer"),
 * @SWG\Property(property="question4", type="integer"),
 * @SWG\Property(property="question5", type="integer"),
 * @SWG\Property(property="question6", type="integer"),
 * @SWG\Property(property="question7", type="integer"),
 * @SWG\Property(property="question8", type="integer"),
 * @SWG\Property(property="question9", type="integer"),
 * @SWG\Property(property="question10", type="integer"),
 * @SWG\Property(property="status", type="string")
 * )
 */


/**
 * * @SWG\Definition(
 * definition="sellerUserAssociation",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="user_id", type="integer"),
 * @SWG\Property(property="type", type="string"),
 * @SWG\Property(property="suburb_id", type="integer"),
 * @SWG\Property(property="state_id", type="integer"),
 * @SWG\Property(property="address", type="string"),
 * @SWG\Property(property="photo", type="string"),
 * @SWG\Property(property="language", type="string"),
 * @SWG\Property(property="find_out", type="string"),
 * @SWG\Property(property="about", type="string"),
 * @SWG\Property(property="newsletter", type="boolean"),
 * @SWG\Property(property="terms", type="boolean"),
 * @SWG\Property(property="smartphone", type="boolean"),
 * @SWG\Property(property="slug", type="string"),
 * @SWG\Property(property="dogs", ref="#/definitions/editDog", description = "Sellers dogs")
 * )
 */

/**
 * * @SWG\Definition(
 * definition="sellerModel",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="user_id", type="integer"),
 * @SWG\Property(property="type", type="string"),
 * @SWG\Property(property="suburb_id", type="integer"),
 * @SWG\Property(property="state_id", type="integer"),
 * @SWG\Property(property="address", type="string"),
 * @SWG\Property(property="photo", type="string"),
 * @SWG\Property(property="language", type="string"),
 * @SWG\Property(property="find_out", type="string"),
 * @SWG\Property(property="about", type="string"),
 * @SWG\Property(property="newsletter", type="boolean"),
 * @SWG\Property(property="terms", type="boolean"),
 * @SWG\Property(property="smartphone", type="boolean"),
 * @SWG\Property(property="slug", type="string")
 * )
 */

/**
 * Class AssociationModel
 * @ORM\Entity(repositoryClass="Modules\Association\Repositories\Entities")
 * @ORM\Table(name="association_entities")
 * * @SWG\Definition(
 * definition="sellerWith",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="user_id", type="integer"),
 * @SWG\Property(property="type", type="string"),
 * @SWG\Property(property="suburb_id", type="integer"),
 * @SWG\Property(property="state_id", type="integer"),
 * @SWG\Property(property="address", type="string", description = " Address of seller"),
 * @SWG\Property(property="photo", type="string", description = " Seller photo path"),
 * @SWG\Property(property="language", type="string", description = " App language"),
 * @SWG\Property(property="find_out", type="string", description = " How did you find out about petagree"),
 * @SWG\Property(property="about", type="string", description = " General information of the association"),
 * @SWG\Property(property="newsletter", type="boolean", description = "Newsletter status"),
 * @SWG\Property(property="terms", type="boolean", description = "Terms status"),
 * @SWG\Property(property="smartphone", type="boolean", description = "Smartphone status"),
 * @SWG\Property(property="verified", type="boolean", description = "Verified status"),
 * @SWG\Property(property="suspicious", type="boolean", description = "Suspicious status"),
 * @SWG\Property(property="slug", type="string", description = "Slug"),
 * @SWG\Property(property="users", type="array", items="string", description = "Users relation"),
 * @SWG\Property(property="review", type="array", items="string", description = "Review relation"),
 * @SWG\Property(property="seller_enquiry", type="array", items="string", description = "Seller_enquiry relation"),
 * @SWG\Property(property="suburb", type="array", items="string", description = "Suburb relation"),
 * @SWG\Property(property="state", type="array", items="string", description = "State relation"),
 * @SWG\Property(property="verification", type="array", items="string", description = "Verifivation relation"),
 * @SWG\Property(property="dogs", type="array", items="string", description = "Dogs relation"),
 * )
 */


/**
 * * @SWG\Definition(
 * definition="sellerSlug",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="user_id", type="integer"),
 * @SWG\Property(property="type", type="string"),
 * @SWG\Property(property="suburb_id", type="integer"),
 * @SWG\Property(property="state_id", type="integer"),
 * @SWG\Property(property="address", type="string", description = " Address of seller"),
 * @SWG\Property(property="photo", type="string", description = " Seller photo path"),
 * @SWG\Property(property="language", type="string", description = " App language"),
 * @SWG\Property(property="find_out", type="string", description = " How did you find out about petagree"),
 * @SWG\Property(property="about", type="string", description = " General information of the association"),
 * @SWG\Property(property="newsletter", type="boolean", description = "Newsletter status"),
 * @SWG\Property(property="terms", type="boolean", description = "Terms status"),
 * @SWG\Property(property="smartphone", type="boolean", description = "Smartphone status"),
 * @SWG\Property(property="verified", type="boolean", description = "Verified status"),
 * @SWG\Property(property="suspicious", type="boolean", description = "Suspicious status"),
 * @SWG\Property(property="slug", type="string", description = "Slug"),
 * @SWG\Property(property="users", ref="#/definitions/userId", description = "User information"),
 * @SWG\Property(property="suburb", ref="#/definitions/suburb", description = "Suburb information"),
 * @SWG\Property(property="state", ref="#/definitions/state", description = "State information"),
 * @SWG\Property(property="verification", ref="#/definitions/sellerVerification", description = "Seller verification information"),
 * @SWG\Property(property="verification_hobby", ref="#/definitions/sellerHobbyVerification", description = "Seller hobby verification information"),
 * @SWG\Property(property="dogs", ref="#/definitions/editDog", description = "Dog information"),
 * @SWG\Property(property="review", ref="#/definitions/review", description = "Review information")
 * )
 */



/**
 * Class AssociationModel
 * @ORM\Entity(repositoryClass="Modules\Association\Repositories\Entities")
 * @ORM\Table(name="association_entities")
 * * @SWG\Definition(
 * definition="sellerSlugDog",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="type", type="string"),
 * @SWG\Property(property="address", type="string", description = " Address of seller"),
 * @SWG\Property(property="photo", type="string", description = " Seller photo path"),
 * @SWG\Property(property="language", type="string", description = " App language"),
 * @SWG\Property(property="find_out", type="string", description = " How did you find out about petagree"),
 * @SWG\Property(property="about", type="string", description = " General information of the association"),
 * @SWG\Property(property="newsletter", type="boolean", description = "Newsletter status"),
 * @SWG\Property(property="terms", type="boolean", description = "Terms status"),
 * @SWG\Property(property="smartphone", type="boolean", description = "Smartphone status"),
 * @SWG\Property(property="verified", type="boolean", description = "Verified status"),
 * @SWG\Property(property="suspicious", type="boolean", description = "Suspicious status"),
 * @SWG\Property(property="slug", type="string", description = "Slug"),
 * @SWG\Property(property="users", ref="#/definitions/userId", description = "User information"),
 * @SWG\Property(property="suburb", ref="#/definitions/suburb", description = "Suburb information"),
 * @SWG\Property(property="state", ref="#/definitions/state", description = "State information")
 * )
 */
