import Content_Curator
import Content_Matcher

class Recommender:
    @staticmethod
    def recommend_based_on_content(actual_ted_talk, NUMBER_OF_RECOMMENDATIONS=5):
        """
        Recommend TED Talks based on content similarity.
        """
        content_curator = Content_Curator.Content_Curator()
        content_matcher = Content_Matcher.Content_Matcher()
        
        catalogue_ted_talks = content_curator.get_all_ted_talks()
        actual_ted_talk_info = content_curator.get_ted_talk_by_title(actual_ted_talk)
        
        recommendations = content_matcher.match_by_tags(actual_ted_talk_info, catalogue_ted_talks)
        recommendations = sorted(recommendations, key=lambda x: x['views'], reverse=True)
        
        return recommendations[:NUMBER_OF_RECOMMENDATIONS]
    
    @staticmethod
    def recommend_based_on_user_interactions(USER_ID=0, NUMBER_OF_RECOMMENDATIONS=5):
        """
        Recommend TED Talks based on user interactions.
        """
        content_curator = Content_Curator.Content_Curator()
        content_matcher = Content_Matcher.Content_Matcher()
        
        interactions_df = content_curator.get_all_interactions()
        
        similarity_matrix = content_matcher.calculate_similarity_matrix(interactions_df)
        
        user_similarity = similarity_matrix[USER_ID]
        similar_users = user_similarity.argsort()[::-1][1:6]
        
        user_interactions = interactions_df[interactions_df['user_id'] == USER_ID]
        watched_talks = set(user_interactions['talk_id'])
        
        recommended_talks = set()
        for similar_user_id in similar_users:
            similar_user_interactions = interactions_df[interactions_df['user_id'] == similar_user_id]
            similar_user_talks = set(similar_user_interactions['talk_id'])
            # Filtrar las charlas nuevas que no ha visto el usuario objetivo
            new_recommendations = similar_user_talks - watched_talks
            recommended_talks.update(new_recommendations)
            
            final_recommendations = list(recommended_talks)[:NUMBER_OF_RECOMMENDATIONS]
            
        return final_recommendations

# example usage
if __name__ == "__main__":
    recommender = Recommender()
    print(recommender.recommend_based_on_content("The power of vulnerability"))
    print(recommender.recommend_based_on_user_interactions())