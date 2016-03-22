<?php
/**
 * Class AssociationModel
 * @ORM\Entity(repositoryClass="Modules\Dog\Repositories\Entities")
 * @ORM\Table(name="dog_entities")
 * * @SWG\Definition(
 * definition="editDog",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="breed_id", type="integer"),
 * @SWG\Property(property="state_id", type="integer"),
 * @SWG\Property(property="suburb_id", type="integer"),
 * @SWG\Property(property="birth_date", type="date"),
 * @SWG\Property(property="type_of_listing", type="string"),
 * @SWG\Property(property="sex", type="string"),
 * @SWG\Property(property="male_qty", type="integer"),
 * @SWG\Property(property="female_qty", type="integer"),
 * @SWG\Property(property="cost", type="integer"),
 * @SWG\Property(property="about", type="string"),
 * @SWG\Property(property="name", type="string"),
 * @SWG\Property(property="mother_id", type="integer"),
 * @SWG\Property(property="father_id", type="integer"),
 * @SWG\Property(property="vaccination", type="boolean"),
 * @SWG\Property(property="vet_checked", type="boolean"),
 * @SWG\Property(property="desexed", type="boolean"),
 * @SWG\Property(property="de_warmed", type="boolean"),
 * @SWG\Property(property="micro_chipped", type="boolean"),
 * @SWG\Property(property="registration_papers", type="boolean"),
 * @SWG\Property(property="family_dog", type="boolean"),
 * @SWG\Property(property="indoor_dog", type="boolean"),
 * @SWG\Property(property="energetic", type="boolean"),
 * @SWG\Property(property="friendly", type="boolean"),
 * @SWG\Property(property="outdoor_dog", type="boolean"),
 * @SWG\Property(property="relaxed", type="boolean"),
 * @SWG\Property(property="seller_id", type="integer"),
 * @SWG\Property(property="listing_status", type="string"),
 * @SWG\Property(property="sold", type="boolean"),
 * @SWG\Property(property="male_sold", type="integer"),
 * @SWG\Property(property="female_sold", type="integer"),
 * )
 */


/**
 * * @SWG\Definition(
 * definition="dogWith",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="breed_id", type="integer"),
 * @SWG\Property(property="state_id", type="integer"),
 * @SWG\Property(property="suburb_id", type="integer"),
 * @SWG\Property(property="birth_date", type="date"),
 * @SWG\Property(property="type_of_listing", type="string"),
 * @SWG\Property(property="sex", type="string"),
 * @SWG\Property(property="male_qty", type="integer"),
 * @SWG\Property(property="female_qty", type="integer"),
 * @SWG\Property(property="cost", type="integer"),
 * @SWG\Property(property="about", type="string"),
 * @SWG\Property(property="name", type="string"),
 * @SWG\Property(property="mother_id", type="integer"),
 * @SWG\Property(property="father_id", type="integer"),
 * @SWG\Property(property="vaccination", type="boolean"),
 * @SWG\Property(property="vet_checked", type="boolean"),
 * @SWG\Property(property="desexed", type="boolean"),
 * @SWG\Property(property="de_warmed", type="boolean"),
 * @SWG\Property(property="micro_chipped", type="boolean"),
 * @SWG\Property(property="registration_papers", type="boolean"),
 * @SWG\Property(property="family_dog", type="boolean"),
 * @SWG\Property(property="indoor_dog", type="boolean"),
 * @SWG\Property(property="energetic", type="boolean"),
 * @SWG\Property(property="friendly", type="boolean"),
 * @SWG\Property(property="outdoor_dog", type="boolean"),
 * @SWG\Property(property="relaxed", type="boolean"),
 * @SWG\Property(property="seller_id", type="integer"),
 * @SWG\Property(property="listing_status", type="string"),
 * @SWG\Property(property="sold", type="boolean"),
 * @SWG\Property(property="male_sold", type="integer"),
 * @SWG\Property(property="female_sold", type="integer"),
 * @SWG\Property(property="owner", ref="#/definitions/sellerWith", description = "Dog breed information"),
 * @SWG\Property(property="breed", ref="#/definitions/dogBreed", description = "Dog breed information"),
 * @SWG\Property(property="mother", ref="#/definitions/dogParents", description = "Dog mother information"),
 * @SWG\Property(property="father", ref="#/definitions/dogParents", description = "Dog father information"),
 * @SWG\Property(property="shelter", ref="#/definitions/shelterWith", description = "Dog father information")
 * )
 */


/**
 * * @SWG\Definition(
 * definition="dogParents",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="name", type="string"),
 * @SWG\Property(property="birth_date", type="date"),
 * @SWG\Property(property="image", type="string"),
 * @SWG\Property(property="temperament", type="boolean"),
 * @SWG\Property(property="energy", type="boolean"),
 * @SWG\Property(property="intelligence", type="boolean"),
 * @SWG\Property(property="maintenance", type="boolean"),
 * @SWG\Property(property="seller_id", type="integer"),
 * @SWG\Property(property="profile_uri", type="string"),
 * @SWG\Property(property="breed", ref="#/definitions/dogBreed", description = "Dog breed information"),
 * )
 */

/**
 * * @SWG\Definition(
 * definition="dogMotherId",
 * @SWG\Property(property="id", type="integer"),
 * )
 */

/**
 * * @SWG\Definition(
 * definition="dogFatherId",
 * @SWG\Property(property="id", type="integer"),
 * )
 */

/**
 * * @SWG\Definition(
 * definition="dogParentData",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="name", type="string"),
 * @SWG\Property(property="breed_id", type="integer"),
 * @SWG\Property(property="birth_date", type="date"),
 * @SWG\Property(property="image", type="string"),
 * @SWG\Property(property="temperament", type="integer"),
 * @SWG\Property(property="energy", type="integer"),
 * @SWG\Property(property="intelligence", type="integer"),
 * @SWG\Property(property="maintenance", type="integer"),
 * @SWG\Property(property="seller_id", type="integer"),
 * @SWG\Property(property="profile_url", type="string"),
 * @SWG\Property(property="breed", ref="#/definitions/dogBreed", description = "Dog breed information")
 * )
 */
