<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product as ModelsProduct;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Product extends Seeder
{

    public function addReviews(){
        $reviews = [
            [
                "Disappointed with the product/service. It did not meet my expectations.",
                "The experience was unsatisfactory. There were several issues that need to be addressed.",
                "Not happy with my purchase. The quality was below par.",
                "Had a bad experience. Would not recommend this.",
                "The service was poor and did not resolve my issue.",
                "Very dissatisfied. The product/service was nothing like advertised.",
                "A complete waste of money. Would not buy again.",
                "Terrible experience. Customer service was unhelpful.",
                "Product broke within a week. Very low quality.",
                "Service was extremely slow and unprofessional.",
                "Regret buying this. It was a total disappointment.",
                "Poor quality and not worth the price.",
                "The worst experience I have had with a product/service.",
                "Did not work as expected. Very frustrating.",
                "Extremely unhappy with the purchase. Would give zero stars if possible.",
                "The product/service was faulty and unusable.",
                "Very poor experience. Nothing worked as it should.",
                "Customer service was rude and unhelpful.",
                "This was a huge letdown. Do not recommend.",
                "Completely dissatisfied. Will not be using this product/service again."
            ],
            [
                "The product/service was below average. Improvements are needed.",
                "Some aspects were okay, but overall it was not what I expected.",
                "Had some issues that affected my experience. Not very satisfied.",
                "The quality was not as good as I hoped. Needs work.",
                "There were a few good points, but overall, it needs improvement.",
                "Slightly better than the worst, but still not great.",
                "It worked, but barely. Not worth the trouble.",
                "Some features were fine, but overall it didn't meet my needs.",
                "The product/service was inconsistent. Had potential but fell short.",
                "Too many issues to overlook. Needs significant improvement.",
                "Better than a one-star experience, but still disappointing.",
                "Had some redeeming qualities, but mostly negative.",
                "Not entirely useless, but close. Needs a lot of improvement.",
                "Service was slow and product didn't perform well.",
                "It was functional, but barely met the minimum requirements.",
                "More problems than positives. Wouldn't recommend.",
                "Slightly better than terrible, but still not good.",
                "Could be better with some serious changes.",
                "Not the worst, but definitely far from good.",
                "Barely passable. Needs a lot of improvement to be acceptable."
            ],
            [
                "An average experience. There were some good and some bad points.",
                "It was okay. Not great, but not terrible either.",
                "Met some of my expectations, but there is room for improvement.",
                "A mixed experience. Some parts were satisfactory, others not so much.",
                "It was decent, but there are definitely areas that could be better.",
                "Service was adequate, but nothing special.",
                "Product/service met basic needs but didn't exceed expectations.",
                "It was fine, but I wouldn't go out of my way to recommend it.",
                "Fairly standard experience. Some ups and downs.",
                "Not bad, but could be improved in several areas.",
                "An acceptable experience overall, with room for enhancement.",
                "It got the job done, but not in the best way possible.",
                "There were some positives, but also notable negatives.",
                "An average product/service. Neither impressed nor disappointed.",
                "Worked as expected, but no wow factor.",
                "Satisfactory, but left some things to be desired.",
                "Met basic expectations, but lacked exceptional qualities.",
                "A middle-of-the-road experience. Some highs and lows.",
                "Reasonable quality, but not outstanding.",
                "Functional and served its purpose, but not memorable."
            ],
            [
                "Had a good experience overall. There were a few minor issues.",
                "Quite satisfied with the product/service. Just a few improvements needed.",
                "Almost perfect. Just a couple of small things could be better.",
                "Very happy with my purchase. A few minor tweaks would make it excellent.",
                "Overall a great experience with some minor areas for improvement.",
                "Really enjoyed the product/service. Just needs a little refinement.",
                "Very good quality. Just a few small things to fix.",
                "Mostly excellent, with a couple of small drawbacks.",
                "Happy with the product/service. Only a few minor issues.",
                "Would recommend, though there's a bit of room for improvement.",
                "Great value for the money. A few minor areas to improve.",
                "Very satisfied. Just a couple of small issues.",
                "Good experience. Just needs a few minor adjustments.",
                "Almost there. A few tweaks would make it perfect.",
                "Impressed overall. Just a couple of minor hiccups.",
                "Very good. Some small issues that could be improved.",
                "Well done. Just a few areas that need attention.",
                "Would give five stars if not for a few minor issues.",
                "Really good product/service. A couple of small improvements needed.",
                "Happy with the experience. Only a few minor concerns."
            ],
            [
                "Had a good experience overall. There were a few minor issues.",
                "Quite satisfied with the product/service. Just a few improvements needed.",
                "Almost perfect. Just a couple of small things could be better.",
                "Very happy with my purchase. A few minor tweaks would make it excellent.",
                "Overall a great experience with some minor areas for improvement.",
                "Really enjoyed the product/service. Just needs a little refinement.",
                "Very good quality. Just a few small things to fix.",
                "Mostly excellent, with a couple of small drawbacks.",
                "Happy with the product/service. Only a few minor issues.",
                "Would recommend, though there's a bit of room for improvement.",
                "Great value for the money. A few minor areas to improve.",
                "Very satisfied. Just a couple of small issues.",
                "Good experience. Just needs a few minor adjustments.",
                "Almost there. A few tweaks would make it perfect.",
                "Impressed overall. Just a couple of minor hiccups.",
                "Very good. Some small issues that could be improved.",
                "Well done. Just a few areas that need attention.",
                "Would give five stars if not for a few minor issues.",
                "Really good product/service. A couple of small improvements needed.",
                "Happy with the experience. Only a few minor concerns."
            ]
        ];

        $products = ModelsProduct::all();

        foreach ($products as $product) {
            for ($i=0; $i < rand(99, 999); $i++) {

                $rating = rand(1, 5);
                $ratingDecimal = rand(1, 99);

                $product->reviews()->create([
                    'rating' => (float)($rating . $ratingDecimal),
                    'user_id' => rand(1, 1122),
                    'comment' => $reviews[$rating - 1][rand(1, 20) - 1]
                ]);
            }

            $average = Review::where('product_id', $product->id)->avg('rating');
            $product->rating = $average;
            $product->save();
        }
    }

    public function run(): void
    {
        // $this->addReviews();
        $comments = [
            [
                "Disappointed with the product/service. It did not meet my expectations.",
                "The experience was unsatisfactory. There were several issues that need to be addressed.",
                "Not happy with my purchase. The quality was below par.",
                "Had a bad experience. Would not recommend this.",
                "The service was poor and did not resolve my issue.",
                "Very dissatisfied. The product/service was nothing like advertised.",
                "A complete waste of money. Would not buy again.",
                "Terrible experience. Customer service was unhelpful.",
                "Product broke within a week. Very low quality.",
                "Service was extremely slow and unprofessional.",
                "Regret buying this. It was a total disappointment.",
                "Poor quality and not worth the price.",
                "The worst experience I have had with a product/service.",
                "Did not work as expected. Very frustrating.",
                "Extremely unhappy with the purchase. Would give zero stars if possible.",
                "The product/service was faulty and unusable.",
                "Very poor experience. Nothing worked as it should.",
                "Customer service was rude and unhelpful.",
                "This was a huge letdown. Do not recommend.",
                "Completely dissatisfied. Will not be using this product/service again."
            ],
            [
                "The product/service was below average. Improvements are needed.",
                "Some aspects were okay, but overall it was not what I expected.",
                "Had some issues that affected my experience. Not very satisfied.",
                "The quality was not as good as I hoped. Needs work.",
                "There were a few good points, but overall, it needs improvement.",
                "Slightly better than the worst, but still not great.",
                "It worked, but barely. Not worth the trouble.",
                "Some features were fine, but overall it didn't meet my needs.",
                "The product/service was inconsistent. Had potential but fell short.",
                "Too many issues to overlook. Needs significant improvement.",
                "Better than a one-star experience, but still disappointing.",
                "Had some redeeming qualities, but mostly negative.",
                "Not entirely useless, but close. Needs a lot of improvement.",
                "Service was slow and product didn't perform well.",
                "It was functional, but barely met the minimum requirements.",
                "More problems than positives. Wouldn't recommend.",
                "Slightly better than terrible, but still not good.",
                "Could be better with some serious changes.",
                "Not the worst, but definitely far from good.",
                "Barely passable. Needs a lot of improvement to be acceptable."
            ],
            [
                "An average experience. There were some good and some bad points.",
                "It was okay. Not great, but not terrible either.",
                "Met some of my expectations, but there is room for improvement.",
                "A mixed experience. Some parts were satisfactory, others not so much.",
                "It was decent, but there are definitely areas that could be better.",
                "Service was adequate, but nothing special.",
                "Product/service met basic needs but didn't exceed expectations.",
                "It was fine, but I wouldn't go out of my way to recommend it.",
                "Fairly standard experience. Some ups and downs.",
                "Not bad, but could be improved in several areas.",
                "An acceptable experience overall, with room for enhancement.",
                "It got the job done, but not in the best way possible.",
                "There were some positives, but also notable negatives.",
                "An average product/service. Neither impressed nor disappointed.",
                "Worked as expected, but no wow factor.",
                "Satisfactory, but left some things to be desired.",
                "Met basic expectations, but lacked exceptional qualities.",
                "A middle-of-the-road experience. Some highs and lows.",
                "Reasonable quality, but not outstanding.",
                "Functional and served its purpose, but not memorable."
            ],
            [
                "Had a good experience overall. There were a few minor issues.",
                "Quite satisfied with the product/service. Just a few improvements needed.",
                "Almost perfect. Just a couple of small things could be better.",
                "Very happy with my purchase. A few minor tweaks would make it excellent.",
                "Overall a great experience with some minor areas for improvement.",
                "Really enjoyed the product/service. Just needs a little refinement.",
                "Very good quality. Just a few small things to fix.",
                "Mostly excellent, with a couple of small drawbacks.",
                "Happy with the product/service. Only a few minor issues.",
                "Would recommend, though there's a bit of room for improvement.",
                "Great value for the money. A few minor areas to improve.",
                "Very satisfied. Just a couple of small issues.",
                "Good experience. Just needs a few minor adjustments.",
                "Almost there. A few tweaks would make it perfect.",
                "Impressed overall. Just a couple of minor hiccups.",
                "Very good. Some small issues that could be improved.",
                "Well done. Just a few areas that need attention.",
                "Would give five stars if not for a few minor issues.",
                "Really good product/service. A couple of small improvements needed.",
                "Happy with the experience. Only a few minor concerns."
            ],
            [
                "Had a good experience overall. There were a few minor issues.",
                "Quite satisfied with the product/service. Just a few improvements needed.",
                "Almost perfect. Just a couple of small things could be better.",
                "Very happy with my purchase. A few minor tweaks would make it excellent.",
                "Overall a great experience with some minor areas for improvement.",
                "Really enjoyed the product/service. Just needs a little refinement.",
                "Very good quality. Just a few small things to fix.",
                "Mostly excellent, with a couple of small drawbacks.",
                "Happy with the product/service. Only a few minor issues.",
                "Would recommend, though there's a bit of room for improvement.",
                "Great value for the money. A few minor areas to improve.",
                "Very satisfied. Just a couple of small issues.",
                "Good experience. Just needs a few minor adjustments.",
                "Almost there. A few tweaks would make it perfect.",
                "Impressed overall. Just a couple of minor hiccups.",
                "Very good. Some small issues that could be improved.",
                "Well done. Just a few areas that need attention.",
                "Would give five stars if not for a few minor issues.",
                "Really good product/service. A couple of small improvements needed.",
                "Happy with the experience. Only a few minor concerns."
            ]
        ];


        $reviews = Review::all();

        foreach ($reviews as $review) {
            $rating = rand(1, 5);
            $review->update([
                'rating' => (int)($rating),
                'user_id' => rand(1, 1122),
                'comment' => $comments[$rating - 1][rand(1, 20) - 1]
            ]);
        }
    }
}
