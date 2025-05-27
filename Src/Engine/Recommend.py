import sys
import json
from Recommender import Recommender

def main():
    # 'content' or 'user'
    mode = sys.argv[1]
    
    if mode == "content":
        title = sys.argv[2]
        number = int(sys.argv[3]) if len(sys.argv) > 3 else 5
        result = Recommender.recommend_based_on_content(title, number)
    elif mode == "user":
        user_id = int(sys.argv[2])
        number = int(sys.argv[3]) if len(sys.argv) > 3 else 5
        result = Recommender.recommend_based_on_user_interactions(user_id, number)
    else:
        result = {"error": "Invalid mode"}

    print(json.dumps(result))

if __name__ == "__main__":
    main()
