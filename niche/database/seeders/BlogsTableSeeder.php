<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('blogs')->insert([
            [
                'author_user_id' => 1,
                'title' => 'The Future of AI in 2024',
                'content' => 'Artificial intelligence is shaping the world with groundbreaking innovations.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 1, // Tech News
            ],
            [
                'author_user_id' => 2,
                'title' => 'Lists of default icons available on Niche!',
                'content' => '<div class="section">            <div class="text-section">I hope this serves as the sample blog posts for whatever reason</div>        </div><div class="section"><div class="marked-section"><h3>List of default icons available through colors!!</h3></div></div><div class="section"><div class="image-section"><div data-image-id="12" class="image-container-uploaded"><img class="uploaded-image"></div><div data-image-id="13" class="image-container-uploaded"><img class="uploaded-image"></div></div></div><div class="section"><div class="image-section"><div data-image-id="10" class="image-container-uploaded"><img class="uploaded-image"></div><div data-image-id="11" class="image-container-uploaded"><img class="uploaded-image"></div></div></div><div class="section"><div class="image-section"><div data-image-id="8" class="image-container-uploaded"><img class="uploaded-image"></div><div data-image-id="9" class="image-container-uploaded"><img class="uploaded-image"></div></div></div><div class="section"><div class="image-section"><div data-image-id="6" class="image-container-uploaded"><img class="uploaded-image"></div><div data-image-id="7" class="image-container-uploaded"><img class="uploaded-image"></div></div></div><div class="section"><div class="image-section"><div data-image-id="4" class="image-container-uploaded"><img class="uploaded-image"></div><div data-image-id="5" class="image-container-uploaded"><img class="uploaded-image"></div></div></div><div class="section"><div class="image-section"><div data-image-id="2" class="image-container-uploaded"><img class="uploaded-image"></div><div data-image-id="3" class="image-container-uploaded"><img class="uploaded-image"></div></div></div><div class="section"><div class="image-section"><div data-image-id="0" class="image-container-uploaded"><img class="uploaded-image"></div><div data-image-id="1" class="image-container-uploaded"><img class="uploaded-image"></div></div></div><div class="section"><div class="marked-section"><h1>THE POWER OF SVG!!!!!!</h1></div></div>',
                'date_created' => DB::raw('NOW() + INTERVAL 5 SECOND'),
                'date_last_updated' => DB::raw('NOW() + INTERVAL 5 SECOND'),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 8, // Tech News
            ],
            [
                'author_user_id' => 2,
                'title' => 'Top 10 AI Tools for Developers in 2024',
                'content' => 'A comprehensive list of the best AI tools that every developer should know about.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 1, // Tech News
            ],
            [
                'author_user_id' => 3,
                'title' => 'How AI is Transforming Healthcare',
                'content' => 'Exploring the impact of artificial intelligence on the healthcare industry.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 1, // Tech News
            ],
            [
                'author_user_id' => 4,
                'title' => 'The Role of AI in Cybersecurity',
                'content' => 'Understanding how AI is being used to enhance cybersecurity measures.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 1, // Tech News
            ],
            [
                'author_user_id' => 5,
                'title' => 'AI Ethics: What You Need to Know',
                'content' => 'A discussion on the ethical considerations surrounding artificial intelligence.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 1, // Tech News
            ],
            [
                'author_user_id' => 2,
                'title' => 'Top 10 Gaming Trends of the Year',
                'content' => 'The gaming world is evolving rapidly with new technologies.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 2, // Gaming
            ],
            [
                'author_user_id' => 3,
                'title' => 'The Rise of Cloud Gaming',
                'content' => 'Cloud gaming is revolutionizing the way we play video games. With the ability to stream games directly to devices without the need for high-end hardware, players can enjoy their favorite titles on a variety of platforms. This shift is making gaming more accessible to a broader audience, allowing anyone with a stable internet connection to dive into immersive worlds and experiences.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 2, // Gaming
            ],
            [
                'author_user_id' => 4,
                'title' => 'The Impact of Virtual Reality on Gaming',
                'content' => 'Virtual reality (VR) is changing the landscape of gaming by providing players with an unparalleled level of immersion. With VR headsets, gamers can step into their favorite games and interact with the environment in ways that were previously unimaginable. This technology is not only enhancing the gaming experience but also opening up new possibilities for storytelling and gameplay mechanics.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 2, // Gaming
            ],
            [
                'author_user_id' => 3,
                'title' => '5 Quick Workouts for Busy People',
                'content' => 'Staying fit doesn’t have to be time-consuming. Here are 5 quick workouts.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 3, // Health & Fitness
            ],
            [
                'author_user_id' => 4,
                'title' => 'The Benefits of Morning Yoga',
                'content' => 'Discover how starting your day with yoga can improve your physical and mental health.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 3, // Health & Fitness
            ],
            [
                'author_user_id' => 5,
                'title' => 'Nutrition Tips for a Healthy Lifestyle',
                'content' => 'Learn about essential nutrition tips that can help you maintain a balanced diet.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 3, // Health & Fitness
            ],
            [
                'author_user_id' => 6,
                'title' => 'How to Stay Motivated to Exercise',
                'content' => 'Tips and tricks to keep you motivated on your fitness journey, even on tough days.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 3, // Health & Fitness
            ],
            [
                'author_user_id' => 4,
                'title' => 'Exploring Hidden Gems in Europe',
                'content' => 'Discover beautiful and less-traveled destinations in Europe.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 4, // Travel Diaries
            ],
            [
                'author_user_id' => 5,
                'title' => '10 Delicious Recipes for Beginners',
                'content' => 'Start cooking with these easy-to-follow recipes.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 5, // Food & Recipes
            ],
            [
                'author_user_id' => 1,
                'title' => 'Mastering Online Learning',
                'content' => 'Tips and tools to make your online learning experience effective.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => false,
                'is_banned' => false,
                'channel_id' => 6, // Education & Learning
            ],
            [
                'author_user_id' => 6,
                'title' => 'Highlights from the Latest World Cup',
                'content' => 'The biggest moments from this year’s World Cup.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 7, // Sports Highlights
            ],
            [
                'author_user_id' => 7,
                'title' => 'Latest Trends in Fashion for 2024',
                'content' => 'Fashion evolves every year, and 2024 is no exception.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 8, // Fashion & Style
            ],
            [
                'author_user_id' => 8,
                'title' => 'Space Exploration: What’s Next?',
                'content' => 'Humanity is reaching new heights in space exploration.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 9, // Science & Technology
            ],
            [
                'author_user_id' => 9,
                'title' => 'Breaking News in Entertainment',
                'content' => 'The entertainment industry is buzzing with exciting news.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 10, // Entertainment News
            ],
            [
                'author_user_id' => 11,
                'title' => 'The Rise of Remote Work',
                'content' => 'Exploring how remote work is changing the corporate landscape.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 11, // Business & Finance
            ],
            [
                'author_user_id' => 12,
                'title' => 'Sustainable Living Tips',
                'content' => 'Simple ways to live a more sustainable lifestyle.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 12, // Lifestyle
            ],
            [
                'author_user_id' => 13,
                'title' => 'Understanding Cryptocurrency',
                'content' => 'A beginner’s guide to cryptocurrency and blockchain technology.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 13, // Cryptocurrency
            ],
            [
                'author_user_id' => 14,
                'title' => 'The Importance of Mental Health',
                'content' => 'Discussing the significance of mental health awareness.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 14, // Mental Health
            ],
            [
                'author_user_id' => 15,
                'title' => 'Traveling on a Budget',
                'content' => 'Tips and tricks for traveling without breaking the bank.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 15, // Travel
            ],
            [
                'author_user_id' => 16,
                'title' => 'The Art of Photography',
                'content' => 'Exploring techniques to improve your photography skills.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 16, // Photography
            ],
            [
                'author_user_id' => 17,
                'title' => 'Healthy Eating Habits',
                'content' => 'How to develop and maintain healthy eating habits.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 17, // Health & Wellness
            ],
            [
                'author_user_id' => 18,
                'title' => 'The Future of Renewable Energy',
                'content' => 'Innovations in renewable energy and their impact on the environment.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 18, // Environment
            ],
            [
                'author_user_id' => 19,
                'title' => 'The Evolution of Music Genres',
                'content' => 'A look at how music genres have evolved over the decades.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 19, // Music
            ],
            [
                'author_user_id' => 8,
                'title' => 'The Impact of Social Media',
                'content' => 'Analyzing the effects of social media on society.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 4, // Social Media
            ],
            [
                'author_user_id' => 1,
                'title' => 'Exploring the World of Virtual Reality',
                'content' => 'How virtual reality is transforming entertainment and education.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 11, // Business & Finance
            ],
            [
                'author_user_id' => 2,
                'title' => 'The Best Indie Games of 2024',
                'content' => 'A roundup of the most exciting indie games to look out for this year.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 12, // Lifestyle
            ],
            [
                'author_user_id' => 3,
                'title' => 'Nutrition Myths Debunked',
                'content' => 'Separating fact from fiction in the world of nutrition.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 13, // Cryptocurrency
            ],
            [
                'author_user_id' => 4,
                'title' => 'Cultural Festivals Around the World',
                'content' => 'A look at some of the most vibrant cultural festivals globally.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 14, // Mental Health
            ],
            [
                'author_user_id' => 5,
                'title' => 'Baking Basics for Beginners',
                'content' => 'Essential tips and recipes for novice bakers.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 15, // Travel
            ],
            [
                'author_user_id' => 6,
                'title' => 'The Benefits of Lifelong Learning',
                'content' => 'Why continuous education is essential in today’s world.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => false,
                'is_banned' => false,
                'channel_id' => 16, // Photography
            ],
            [
                'author_user_id' => 7,
                'title' => 'The Evolution of Sports Technology',
                'content' => 'How technology is changing the way we play and watch sports.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 17, // Health & Wellness
            ],
            [
                'author_user_id' => 8,
                'title' => 'Sustainable Fashion Trends',
                'content' => 'Exploring eco-friendly practices in the fashion industry.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 18, // Environment
            ],
            [
                'author_user_id' => 9,
                'title' => 'The Science of Climate Change',
                'content' => 'Understanding the causes and effects of climate change.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 19, // Music
            ],
            [
                'author_user_id' => 11,
                'title' => 'The Impact of Artificial Intelligence on Jobs',
                'content' => 'Exploring how AI is changing the job market and what it means for the future.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 1, // Tech News
            ],
            [
                'author_user_id' => 12,
                'title' => 'The Best Mobile Games of 2024',
                'content' => 'A look at the most popular mobile games to play this year.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 2, // Gaming
            ],
            [
                'author_user_id' => 13,
                'title' => 'Yoga for Beginners: A Guide',
                'content' => 'An introduction to yoga and its benefits for beginners.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 3, // Health & Fitness
            ],
            [
                'author_user_id' => 14,
                'title' => 'Traveling Solo: Tips and Tricks',
                'content' => 'How to make the most of your solo travel experience.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 4, // Travel Diaries
            ],
            [
                'author_user_id' => 15,
                'title' => 'Meal Prep Ideas for Busy People',
                'content' => 'Quick and easy meal prep ideas to save time during the week.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 5, // Food & Recipes
            ],
            [
                'author_user_id' => 16,
                'title' => 'The Importance of Critical Thinking',
                'content' => 'Why critical thinking skills are essential in today’s world.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => false,
                'is_banned' => false,
                'channel_id' => 6, // Education & Learning
            ],
            [
                'author_user_id' => 17,
                'title' => 'The Future of Sports Analytics',
                'content' => 'How data analytics is changing the way we understand sports.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 7, // Sports Highlights
            ],
            [
                'author_user_id' => 18,
                'title' => 'Fashion Icons of the 21st Century',
                'content' => 'A look at the most influential fashion icons of our time.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 8, // Fashion & Style
            ],
            [
                'author_user_id' => 19,
                'title' => 'Innovations in Renewable Energy',
                'content' => 'Exploring the latest advancements in renewable energy technologies.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_banned' => false,
                'channel_id' => 9, // Science & Technology
            ],
       
        ]);
    }
}